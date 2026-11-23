@extends('layouts.app')
@section('title', 'Masuk | Sougen Creative Management')

@section('content')
<div class="container py-5" style="max-width:460px">
  <div class="sg-panel">
    <h1 class="h3 mb-4">Masuk</h1>
    <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf
      <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror" required autofocus>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password"
               class="form-control @error('password') is-invalid @enderror" required>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">Ingat saya</label>
      </div>
      <button class="btn btn-gold w-100">Masuk</button>
    </form>
    <p class="small mt-3 mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
  </div>
</div>
@endsection