@extends('layouts.app')
@section('title', 'Tentang Kami | Sougen Creative Management')

@section('content')
<div class="container py-5">
  <h1 class="h2 sg-section-title mb-4">Tentang Kami</h1>
  <div class="sg-panel mb-4">{!! nl2br(e($company?->about)) !!}</div>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="sg-panel h-100">
        <h2 class="h4 sg-gold">Visi</h2>
        {!! nl2br(e($company?->vision)) !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="sg-panel h-100">
        <h2 class="h4 sg-gold">Misi</h2>
        {!! nl2br(e($company?->mission)) !!}
      </div>
    </div>
  </div>
</div>
@endsection