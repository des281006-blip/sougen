@extends('layouts.app')
@section('title', 'Layanan | Sougen Creative Management')

@section('content')
<div class="container py-5">
  <h1 class="h2 sg-section-title mb-4">Layanan</h1>
  <div class="sg-panel">{!! nl2br(e($company?->services)) !!}</div>
  <div class="mt-4">
    <a href="{{ route('events.index') }}" class="btn btn-gold">Lihat Event</a>
    <a href="{{ route('contact') }}" class="btn btn-outline-light ms-2">Hubungi Kami</a>
  </div>
</div>
@endsection