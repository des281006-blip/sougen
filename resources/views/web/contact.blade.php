@extends('layouts.app')
@section('title', 'Kontak | Sougen Creative Management')

@section('content')
<div class="container py-5">
  <h1 class="h2 sg-section-title mb-4">Kontak</h1>
  <div class="sg-panel">
    <ul class="list-unstyled mb-0">
      @if ($company?->address)<li class="mb-2"><i class="bi bi-geo-alt sg-gold"></i> {{ $company->address }}</li>@endif
      @if ($company?->email)<li class="mb-2"><i class="bi bi-envelope sg-gold"></i> {{ $company->email }}</li>@endif
      @if ($company?->phone)<li class="mb-2"><i class="bi bi-telephone sg-gold"></i> {{ $company->phone }}</li>@endif
      @foreach (($company?->social_links ?? []) as $nama => $url)
        <li class="mb-2"><i class="bi bi-link-45deg sg-gold"></i>
          <span class="text-capitalize">{{ $nama }}</span>: {{ $url }}</li>
      @endforeach
    </ul>
  </div>
  <p class="small text-muted mt-3">Informasi kontak masih data contoh dan akan diganti lewat dashboard admin.</p>
</div>
@endsection