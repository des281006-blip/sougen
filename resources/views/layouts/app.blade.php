<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Sougen Creative Management')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/sougen.css') }}" rel="stylesheet">
  @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sg-nav sticky-top">
  <div class="container">
    <a class="navbar-brand sg-brand" href="{{ route('home') }}">
      <i class="bi bi-flower1"></i> {{ $company?->name ?? 'Sougen Creative Management' }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama"
            aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuUtama">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index') }}">Event</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Layanan</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galeri</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="{{ route('news.index') }}">Berita</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a></li>
        @if (Route::has('login'))
          <li class="nav-item ms-lg-2">
            @auth
              <span class="nav-link">Halo, {{ auth()->user()->name }}</span>
            @else
              <a class="btn btn-gold btn-sm" href="{{ route('login') }}">Masuk</a>
            @endauth
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

@if (session('success'))
  <div class="container mt-3"><div class="alert alert-success mb-0">{{ session('success') }}</div></div>
@endif
@if (session('error'))
  <div class="container mt-3"><div class="alert alert-danger mb-0">{{ session('error') }}</div></div>
@endif

<main>@yield('content')</main>

<footer class="sg-footer mt-5 py-4">
  <div class="container">
    <div class="row g-3">
      <div class="col-md-6">
        <strong class="sg-gold">{{ $company?->name ?? 'Sougen Creative Management' }}</strong>
        <p class="small text-muted mb-0">{{ $company?->tagline }}</p>
      </div>
      <div class="col-md-6 small text-md-end">
        @if ($company?->email)<div><i class="bi bi-envelope"></i> {{ $company->email }}</div>@endif
        @if ($company?->phone)<div><i class="bi bi-telephone"></i> {{ $company->phone }}</div>@endif
        <div class="text-muted mt-2">&copy; {{ date('Y') }} Sougen Creative Management</div>
      </div>
    </div>
  </div>
</footer>

{{-- Quick Feature Dock --}}
@php
  $dock = [
    ['icon' => 'bi-calendar-event',    'label' => 'Katalog Event', 'url' => route('events.index')],
    ['icon' => 'bi-ticket-perforated', 'label' => 'Beli Tiket',    'url' => route('events.index') . '#upcoming'],
    ['icon' => 'bi-qr-code',           'label' => 'Tiket Saya',    'url' => Route::has('tickets.index') ? route('tickets.index') : '#'],
    ['icon' => 'bi-envelope',          'label' => 'Kontak',        'url' => route('contact')],
  ];
@endphp
<nav class="sg-dock" aria-label="Akses cepat">
  @foreach ($dock as $item)
    <a href="{{ $item['url'] }}"><i class="bi {{ $item['icon'] }}"></i>{{ $item['label'] }}</a>
  @endforeach
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>