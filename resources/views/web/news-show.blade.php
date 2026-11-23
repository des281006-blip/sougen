@extends('layouts.app')
@section('title', $news->title . ' | Sougen Creative Management')

@section('content')
<div class="container py-5" style="max-width:820px">
  <a href="{{ route('news.index') }}" class="small">&larr; Semua berita</a>
  <h1 class="h2 mt-3">{{ $news->title }}</h1>
  <p class="text-muted">{{ $news->published_at->translatedFormat('d F Y') }}</p>
  @if ($news->cover_path)
    <img src="{{ asset('storage/' . $news->cover_path) }}" class="img-fluid rounded mb-4" alt="{{ $news->title }}">
  @endif
  <div class="sg-panel">{!! nl2br(e($news->body)) !!}</div>
</div>
@endsection