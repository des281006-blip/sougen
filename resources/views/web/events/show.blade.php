@extends('layouts.app')
@section('title', $event->title . ' | Sougen Creative Management')

@section('content')
@php
  $statusLabel = ['upcoming' => 'Mendatang', 'ongoing' => 'Berlangsung', 'finished' => 'Selesai'];
  $buyUrl = Route::has('orders.create') ? route('orders.create', $event) : null;
  $open = $event->isSalesOpen();
  $totalRemaining = $event->ticketTypes->sum(fn ($t) => $t->remaining);
@endphp
<div class="container py-5">
  <a href="{{ route('events.index') }}" class="small">&larr; Kembali ke katalog</a>

  <div class="row g-4 mt-1">
    <div class="col-lg-5">
      @if ($event->poster_path)
        <img src="{{ asset('storage/' . $event->poster_path) }}" class="img-fluid rounded w-100"
             alt="Poster {{ $event->title }}">
      @else
        <div class="sg-poster sg-poster-placeholder rounded" style="min-height:280px"><i class="bi bi-stars"></i></div>
      @endif
    </div>

    <div class="col-lg-7">
      <div class="mb-2">
        @if ($event->is_free)
          <span class="badge sg-badge-free">Gratis</span>
        @else
          <span class="badge sg-badge-paid">Berbayar</span>
        @endif
        <span class="badge bg-light text-dark ms-1">{{ $statusLabel[$event->status] ?? $event->status }}</span>
      </div>
      <h1 class="h2">{{ $event->title }}</h1>

      <ul class="list-unstyled my-3">
        <li class="mb-1"><i class="bi bi-calendar3 sg-gold"></i>
          {{ $event->starts_at->translatedFormat('l, d F Y') }}</li>
        <li class="mb-1"><i class="bi bi-clock sg-gold"></i>
          {{ $event->starts_at->format('H:i') }}@if ($event->ends_at) &ndash; {{ $event->ends_at->format('H:i') }}@endif WITA</li>
        <li class="mb-1"><i class="bi bi-geo-alt sg-gold"></i> {{ $event->location }}</li>
      </ul>

      <div class="sg-panel mb-4">{!! nl2br(e($event->description)) !!}</div>

      <h2 class="h5 sg-section-title mb-3">Jenis Tiket</h2>
      <div class="table-responsive">
        <table class="table sg-table align-middle">
          <thead><tr><th>Jenis</th><th>Harga</th><th>Tersisa</th></tr></thead>
          <tbody>
            @forelse ($event->ticketTypes as $t)
              <tr>
                <td>{{ $t->name }}</td>
                <td>{{ $t->price > 0 ? 'Rp ' . number_format($t->price, 0, ',', '.') : 'Gratis' }}</td>
                <td>{{ $t->remaining > 0 ? $t->remaining : 'Habis' }}</td>
              </tr>
            @empty
              <tr><td colspan="3" class="text-muted">Jenis tiket belum diatur.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if ($event->status === 'finished')
        <div class="alert alert-secondary">Event ini telah selesai.</div>
      @elseif (! $open)
        <div class="alert alert-warning">Penjualan tiket belum dibuka atau sudah ditutup.</div>
      @elseif ($totalRemaining < 1)
        <div class="alert alert-warning">Tiket sudah habis.</div>
      @elseif ($buyUrl)
        <a href="{{ $buyUrl }}" class="btn btn-gold btn-lg">
          {{ $event->is_free ? 'Reservasi Tiket Gratis' : 'Beli Tiket' }}
        </a>
      @else
        <button class="btn btn-gold btn-lg" disabled>{{ $event->is_free ? 'Reservasi Tiket Gratis' : 'Beli Tiket' }}</button>
        <p class="small text-muted mt-2">Fitur pemesanan belum aktif (dibuat pada batch berikutnya).</p>
      @endif
    </div>
  </div>
</div>
@endsection