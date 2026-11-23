@extends('layouts.app')
@section('title', 'Daftar | Sougen Creative Management')

@section('content')
<div class="container py-5" style="max-width:520px">
  <div class="sg-panel">
    <h1 class="h3 mb-4">Buat Akun</h1>
    <form method="POST" action="{{ route('register') }}" novalidate>
      @csrf
      <div class="mb-3">
        <label class="form-label" for="name">Nama lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
               class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="phone">Nomor telepon</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="081234567890"
               class="form-control @error('phone') is-invalid @enderror" required>
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label d-block">Daftar sebagai</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="role" id="r1" value="visitor"
                 {{ old('role', 'visitor') === 'visitor' ? 'checked' : '' }}>
          <label class="form-check-label" for="r1">Pengunjung</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="role" id="r2" value="tenant"
                 {{ old('role') === 'tenant' ? 'checked' : '' }}>
          <label class="form-check-label" for="r2">Penyewa Tenant</label>
        </div>
        @error('role')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="password">Password (minimal 8 karakter)</label>
        <input type="password" id="password" name="password"
               class="form-control @error('password') is-invalid @enderror" required>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="password_confirmation">Ulangi password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
      </div>
      <button class="btn btn-gold w-100">Daftar</button>
    </form>
    <p class="small mt-3 mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
  </div>
</div>
@endsection