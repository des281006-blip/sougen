@extends('layouts.app')
@section('title', 'Katalog Event | Sougen Creative Management')

@section('content')
<div class="container py-5" id="upcoming">
  <h1 class="h2 sg-section-title mb-4">Katalog Event</h1>

  <div class="d-flex flex-wrap gap-2 mb-4">
    <a class="btn {{ $tab === 'mendatang' ? 'btn-gold' : 'btn-outline-light' }}"
       href="{{ route('events.index', array_filter(['tab' => 'mendatang', 'jenis' => $jenis])) }}">Mendatang</a>
    <a class="btn {{ $tab === 'selesai' ? 'btn-gold' : 'btn-outline-light' }}"
       href="{{ route('events.index', array_filter(['tab' => 'selesai', 'jenis' => $jenis])) }}">Sudah Selesai</a>

    <span class="vr mx-2 d-none d-md-block"></span>

    <a class="btn btn-sm {{ ! $jenis ? 'btn-info' : 'btn-outline-info' }}"
       href="{{ route('events.index', ['tab' => $tab]) }}">Semua</a>
    <a class="btn btn-sm {{ $jenis === 'gratis' ? 'btn-info' : 'btn-outline-info' }}"
       href="{{ route('events.index', ['tab' => $tab, 'jenis' => 'gratis']) }}">Gratis</a>
    <a class="btn btn-sm {{ $jenis === 'berbayar' ? 'btn-info' : 'btn-outline-info' }}"
       href="{{ route('events.index', ['tab' => $tab, 'jenis' => 'berbayar']) }}">Berbayar</a>
  </div>

  <div class="row g-4">
    @forelse ($events as $event)
      <div class="col-md-6 col-lg-4"><x-event-card :event="$event" /></div>
    @empty
      <p class="text-muted">Tidak ada event pada kategori ini.</p>
    @endforelse
  </div>

  <div class="mt-4">{{ $events->links() }}</div>
</div>
@endsection