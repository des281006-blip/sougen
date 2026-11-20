<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahan kolom pada tabel users bawaan Laravel
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('role', 20)->default('visitor')->after('phone')->index(); // admin | visitor | tenant
        });

        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->text('about')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('services')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('poster_path')->nullable();
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->string('location');
            $table->boolean('is_free')->default(false);
            $table->string('status', 20)->default('upcoming'); // upcoming | ongoing | finished
            $table->dateTime('sales_start_at')->nullable();
            $table->dateTime('sales_end_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'starts_at']);
        });

        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('price')->default(0); // rupiah, tidak boleh negatif
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedInteger('sold')->default(0);
            $table->unsignedSmallInteger('max_per_order')->default(5);
            $table->timestamps();

            $table->index('event_id');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('event_id')->constrained()->restrictOnDelete();
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone', 20);
            $table->unsignedInteger('total_amount')->default(0);
            $table->string('status', 20)->default('pending'); // pending | paid | failed | expired | cancelled
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['event_id', 'status']);
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->constrained()->restrictOnDelete();
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('unit_price'); // harga disalin saat pesan
            $table->unsignedInteger('subtotal');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->restrictOnDelete();
            $table->string('reference')->unique();
            $table->string('method', 20); // qris | va | ewallet | free
            $table->string('mode', 20)->default('simulation'); // simulation | midtrans
            $table->unsignedInteger('amount');
            $table->string('status', 20)->default('pending'); // pending | success | failed | expired
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'status']);
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->restrictOnDelete();
            $table->foreignId('order_item_id')->constrained()->restrictOnDelete();
            $table->foreignId('ticket_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('event_id')->constrained()->restrictOnDelete();
            $table->string('ticket_code', 40)->unique();
            $table->string('holder_name');
            $table->string('status', 20)->default('active'); // active | used | cancelled
            $table->timestamps();

            $table->index(['event_id', 'status']);
        });

        Schema::create('ticket_checkins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->unique()->constrained()->restrictOnDelete(); // unique = tidak bisa check-in 2x
            $table->foreignId('checked_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('checked_in_at');
            $table->timestamps();
        });

        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('business_name');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone', 20);
            $table->timestamps();
        });

        Schema::create('tenant_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->foreignId('event_id')->constrained()->restrictOnDelete();
            $table->string('booth_category');
            $table->unsignedSmallInteger('booth_qty')->default(1);
            $table->unsignedInteger('unit_price')->default(0);
            $table->unsignedInteger('total_fee')->default(0);
            $table->string('status', 20)->default('submitted'); // submitted | approved | rejected | paid | cancelled
            $table->text('admin_note')->nullable();
            $table->timestamps();

            $table->index(['event_id', 'status']);
        });

        Schema::create('tenant_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_application_id')->constrained()->restrictOnDelete();
            $table->string('reference')->unique();
            $table->string('method', 20);
            $table->string('mode', 20)->default('simulation');
            $table->unsignedInteger('amount');
            $table->string('status', 20)->default('pending'); // pending | success | failed | expired
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('body');
            $table->string('cover_path')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('tenant_payments');
        Schema::dropIfExists('tenant_applications');
        Schema::dropIfExists('tenants');
        Schema::dropIfExists('ticket_checkins');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('events');
        Schema::dropIfExists('company_profiles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'role']);
        });
    }
};