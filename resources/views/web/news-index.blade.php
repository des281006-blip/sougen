@extends('layouts.app')
@section('title', 'Berita | Sougen Creative Management')

@section('content')
<div class="container py-5">
  <h1 class="h2 sg-section-title mb-4">Berita &amp; Kegiatan</h1>
  <div class="row g-4">
    @forelse ($items as $item)
      <div class="col-md-6 col-lg-4">
        <div class="sg-panel h-100">
          <small class="text-muted">{{ $item->published_at->translatedFormat('d F Y') }}</small>
          <h2 class="h5 mt-1"><a href="{{ route('news.show', $item) }}">{{ $item->title }}</a></h2>
          <p class="small mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($item->body), 140) }}</p>
        </div>
      </div>
    @empty
      <p class="text-muted">Belum ada berita.</p>
    @endforelse
  </div>
  <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection