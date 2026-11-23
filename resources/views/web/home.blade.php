@extends('layouts.app')
@section('title', 'Beranda | Sougen Creative Management')

@section('content')
<section class="sg-hero text-center">
  <div class="container py-5">
    <p class="sg-eyebrow">Event Organizer Bertema Jejepangan</p>
    <h1 class="display-5 fw-bold">{{ $company?->name ?? 'Sougen Creative Management' }}</h1>
    <p class="lead mx-auto" style="max-width:640px">{{ $company?->tagline }}</p>
    <a href="{{ route('events.index') }}" class="btn btn-gold btn-lg me-2 mb-2">Lihat Event</a>
    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg mb-2">Tentang Kami</a>
  </div>
</section>

<section class="container py-5" id="upcoming">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 sg-section-title mb-0">Event Mendatang</h2>
    <a href="{{ route('events.index') }}">Lihat semua</a>
  </div>
  <div class="row g-4">
    @forelse ($upcoming as $event)
      <div class="col-md-6 col-lg-4"><x-event-card :event="$event" /></div>
    @empty
      <p class="text-muted">Belum ada event mendatang.</p>
    @endforelse
  </div>
</section>

<section class="container pb-5">
  <h2 class="h3 sg-section-title mb-4">Layanan Kami</h2>
  <div class="sg-panel">
    {!! nl2br(e($company?->services)) !!}
    <div class="mt-3"><a href="{{ route('services') }}">Selengkapnya &rarr;</a></div>
  </div>
</section>

<section class="container pb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 sg-section-title mb-0">Portofolio Acara</h2>
    <a href="{{ route('events.index', ['tab' => 'selesai']) }}">Lihat semua</a>
  </div>
  <div class="row g-4">
    @forelse ($finished as $event)
      <div class="col-md-6 col-lg-4"><x-event-card :event="$event" /></div>
    @empty
      <p class="text-muted">Belum ada riwayat event.</p>
    @endforelse
  </div>
</section>

<section class="container pb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 sg-section-title mb-0">Galeri</h2>
    <a href="{{ route('gallery') }}">Lihat semua</a>
  </div>
  <div class="row g-3">
    @forelse ($galleries as $g)
      <div class="col-6 col-md-4">
        <img src="{{ asset('storage/' . $g->image_path) }}" class="img-fluid rounded sg-poster"
             alt="{{ $g->title }}" loading="lazy">
      </div>
    @empty
      <p class="text-muted">Belum ada foto dokumentasi. Admin dapat menambahkannya lewat dashboard.</p>
    @endforelse
  </div>
</section>

<section class="container pb-5">
  <h2 class="h3 sg-section-title mb-4">Berita Terbaru</h2>
  <div class="row g-4">
    @forelse ($news as $item)
      <div class="col-md-4">
        <div class="sg-panel h-100">
          <small class="text-muted">{{ $item->published_at->translatedFormat('d F Y') }}</small>
          <h3 class="h5 mt-1"><a href="{{ route('news.show', $item) }}">{{ $item->title }}</a></h3>
          <p class="small mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($item->body), 110) }}</p>
        </div>
      </div>
    @empty
      <p class="text-muted">Belum ada berita.</p>
    @endforelse
  </div>
</section>

<section class="container pb-5">
  <h2 class="h3 sg-section-title mb-4">Sponsor &amp; Mitra</h2>
  <div class="sg-panel text-center text-muted">
    [CONTOH] Area logo sponsor dan mitra. Akan diisi setelah ada data resmi.
  </div>
</section>
@endsection