@extends('layouts.app')
@section('title', 'Galeri | Sougen Creative Management')

@section('content')
<div class="container py-5">
  <h1 class="h2 sg-section-title mb-4">Galeri Dokumentasi</h1>
  <div class="row g-3">
    @forelse ($galleries as $g)
      <div class="col-6 col-md-4 col-lg-3">
        <figure class="mb-0">
          <img src="{{ asset('storage/' . $g->image_path) }}" class="img-fluid rounded sg-poster"
               alt="{{ $g->title }}" loading="lazy">
          <figcaption class="small mt-1">{{ $g->title }}</figcaption>
        </figure>
      </div>
    @empty
      <p class="text-muted">Belum ada foto dokumentasi.</p>
    @endforelse
  </div>
  <div class="mt-4">{{ $galleries->links() }}</div>
</div>
@endsection