<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') | Admin Sougen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/sougen.css') }}" rel="stylesheet">
  <style>
    body { padding-bottom: 0; }
    .sg-side { background: var(--sg-navy-dark); min-height: 100vh; border-right: 2px solid var(--sg-maroon); }
    .sg-side .nav-link { color: #e9e5ff; border-radius: 8px; }
    .sg-side .nav-link:hover, .sg-side .nav-link.active { background: rgba(245,197,66,.15); color: var(--sg-gold); }
    .sg-side .nav-link.soon { opacity: .45; pointer-events: none; }
  </style>
  @stack('styles')
</head>
<body>
@php
  $menu = [
    ['Dashboard',         'bi-speedometer2',           'admin.dashboard'],
    ['Company Profile',   'bi-building',               'admin.company.edit'],
    ['Galeri dan Berita', 'bi-images',                 'admin.galleries.index'],
    ['Manajemen Event',   'bi-calendar-event',         'admin.events.index'],
    ['Jenis Tiket',       'bi-ticket-perforated',      'admin.ticket-types.index'],
    ['Pesanan Tiket',     'bi-bag-check',              'admin.orders.index'],
    ['Pembayaran',        'bi-credit-card',            'admin.payments.index'],
    ['Pengajuan Tenant',  'bi-shop',                   'admin.tenant-applications.index'],
    ['Transaksi Tenant',  'bi-cash-coin',              'admin.tenant-payments.index'],
    ['E-Ticket',          'bi-qr-code',                'admin.tickets.index'],
    ['Check-in',          'bi-upc-scan',               'admin.checkin.index'],
    ['Laporan',           'bi-file-earmark-bar-graph', 'admin.reports.index'],
  ];
@endphp
<div class="container-fluid">
  <div class="row">
    <aside class="col-md-3 col-lg-2 sg-side p-3">
      <a href="{{ route('admin.dashboard') }}" class="sg-brand d-block mb-3 text-decoration-none">
        <i class="bi bi-flower1"></i> Sougen Admin
      </a>
      <ul class="nav flex-column gap-1">
        @foreach ($menu as [$label, $icon, $routeName])
          @php $ada = Route::has($routeName); @endphp
          <li class="nav-item">
            <a class="nav-link {{ $ada && request()->routeIs($routeName) ? 'active' : '' }} {{ $ada ? '' : 'soon' }}"
               href="{{ $ada ? route($routeName) : '#' }}">
              <i class="bi {{ $icon }}"></i> {{ $label }}
              @unless ($ada)<small>(segera)</small>@endunless
            </a>
          </li>
        @endforeach
        <li class="nav-item mt-2">
          <a class="nav-link" href="{{ route('home') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Website
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-link btn btn-link text-start w-100">
              <i class="bi bi-box-arrow-left"></i> Logout
            </button>
          </form>
        </li>
      </ul>
    </aside>

    <main class="col-md-9 col-lg-10 p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">@yield('heading', 'Dashboard')</h1>
        <small class="text-muted">{{ auth()->user()->name }} (admin)</small>
      </div>

      @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
      @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
      @if ($errors->any())
        <div class="alert alert-danger">Ada isian yang perlu diperbaiki. Periksa pesan di bawah kolom.</div>
      @endif

      @yield('content')
    </main>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>