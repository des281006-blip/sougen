<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SougenSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun admin dari .env (password tidak ditulis di kode)
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            $this->command->error('ADMIN_EMAIL dan ADMIN_PASSWORD belum diisi di .env. Admin tidak dibuat.');
        } else {
            $admin = User::firstOrNew(['email' => $email]);
            $admin->forceFill([
                'name' => env('ADMIN_NAME', 'Admin Sougen'),
                'password' => Hash::make($password),
                'role' => 'admin',
                'email_verified_at' => now(),
            ])->save();
            $this->command->info("Admin siap: {$email}");
        }

        // 2. Profil perusahaan (DATA CONTOH, ganti lewat dashboard admin)
        CompanyProfile::firstOrCreate(['id' => 1], [
            'name' => 'Sougen Creative Management',
            'tagline' => '[CONTOH] Event Organizer bertema jejepangan',
            'about' => '[CONTOH - SESUAIKAN] Isi profil resmi perusahaan di sini.',
            'vision' => '[CONTOH - SESUAIKAN] Visi perusahaan.',
            'mission' => '[CONTOH - SESUAIKAN] Misi perusahaan.',
            'services' => '[CONTOH - SESUAIKAN] Layanan: penyelenggaraan event, sewa booth, kemitraan sponsor.',
            'address' => '[CONTOH - SESUAIKAN] Alamat kantor',
            'email' => 'info@contoh.test',
            'phone' => '0800-0000-0000',
            'social_links' => ['instagram' => '#', 'youtube' => '#'],
        ]);

        // 3. Event contoh
        $paid = Event::firstOrCreate(['slug' => 'contoh-festival-berbayar'], [
            'title' => '[CONTOH] Festival Jejepangan (Berbayar)',
            'description' => 'Data contoh. Ganti lewat dashboard admin.',
            'starts_at' => now()->addDays(30)->setTime(10, 0),
            'ends_at' => now()->addDays(30)->setTime(20, 0),
            'location' => '[CONTOH] Makassar',
            'is_free' => false,
            'status' => 'upcoming',
            'sales_start_at' => now(),
            'sales_end_at' => now()->addDays(29),
        ]);
        if ($paid->ticketTypes()->count() === 0) {
            $paid->ticketTypes()->createMany([
                ['name' => 'Regular', 'price' => 50000, 'stock' => 200, 'max_per_order' => 5],
                ['name' => 'VIP', 'price' => 150000, 'stock' => 50, 'max_per_order' => 3],
            ]);
        }

        $free = Event::firstOrCreate(['slug' => 'contoh-workshop-gratis'], [
            'title' => '[CONTOH] Workshop Budaya Jepang (Gratis)',
            'description' => 'Data contoh event gratis dengan reservasi tiket.',
            'starts_at' => now()->addDays(14)->setTime(13, 0),
            'location' => '[CONTOH] Makassar',
            'is_free' => true,
            'status' => 'upcoming',
        ]);
        if ($free->ticketTypes()->count() === 0) {
            $free->ticketTypes()->create(['name' => 'Reservasi Gratis', 'price' => 0, 'stock' => 100, 'max_per_order' => 2]);
        }

        Event::firstOrCreate(['slug' => 'contoh-festival-selesai'], [
            'title' => '[CONTOH] Festival Tahun Lalu',
            'description' => 'Data contoh event yang sudah selesai.',
            'starts_at' => now()->subMonths(6),
            'location' => '[CONTOH] Makassar',
            'is_free' => false,
            'status' => 'finished',
        ]);
    }
}