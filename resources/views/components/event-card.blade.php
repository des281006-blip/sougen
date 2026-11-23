@props(['event'])
@php
  $min = $event->ticketTypes->min('price');
  $statusLabel = ['upcoming' => 'Mendatang', 'ongoing' => 'Berlangsung', 'finished' => 'Selesai'];
@endphp
<div class="card sg-card h-100">
  @if ($event->poster_path)
    <img src="{{ asset('storage/' . $event->poster_path) }}" class="sg-poster"
         alt="Poster {{ $event->title }}" loading="lazy">
  @else
    <div class="sg-poster sg-poster-placeholder"><i class="bi bi-stars"></i></div>
  @endif
  <div class="card-body d-flex flex-column">
    <div class="mb-2">
      @if ($event->is_free)
        <span class="badge sg-badge-free">Gratis</span>
      @else
        <span class="badge sg-badge-paid">Berbayar</span>
      @endif
      <span class="badge bg-light text-dark ms-1">{{ $statusLabel[$event->status] ?? $event->status }}</span>
    </div>
    <h5 class="card-title">{{ $event->title }}</h5>
    <p class="small mb-1"><i class="bi bi-calendar3"></i> {{ $event->starts_at->translatedFormat('d F Y, H:i') }} WITA</p>
    <p class="small mb-3"><i class="bi bi-geo-alt"></i> {{ $event->location }}</p>
    <div class="mt-auto d-flex justify-content-between align-items-center">
      <strong class="sg-gold">
        @if ($event->is_free) Gratis
        @elseif ($min !== null) Mulai Rp {{ number_format($min, 0, ',', '.') }}
        @else Harga belum diatur
        @endif
      </strong>
      <a href="{{ route('events.show', $event) }}" class="btn btn-gold btn-sm">Detail</a>
    </div>
  </div>
</div>