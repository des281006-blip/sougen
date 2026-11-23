@extends('layouts.admin')
@section('title', 'Company Profile')
@section('heading', 'Company Profile')

@section('content')
@php
  $sosial = $profile->social_links ?? [];
  $bersih = fn ($v) => ($v === '#' ? '' : $v);
@endphp
<form method="POST" action="{{ route('admin.company.update') }}" class="sg-panel" novalidate>
  @csrf
  @method('PUT')

  <p class="small text-muted">Bagian bertanda [CONTOH] adalah data contoh. Ganti dengan informasi resmi perusahaan.</p>

  @foreach ([
    ['name',     'Nama perusahaan', 'input'],
    ['tagline',  'Tagline',         'input'],
    ['about',    'Tentang kami',    'textarea'],
    ['vision',   'Visi',            'textarea'],
    ['mission',  'Misi',            'textarea'],
    ['services', 'Layanan',         'textarea'],
    ['address',  'Alamat',          'input'],
    ['email',    'Email',           'input'],
    ['phone',    'Telepon',         'input'],
  ] as [$field, $label, $type])
    <div class="mb-3">
      <label class="form-label" for="{{ $field }}">{{ $label }}</label>
      @if ($type === 'textarea')
        <textarea id="{{ $field }}" name="{{ $field }}" rows="4"
          class="form-control @error($field) is-invalid @enderror">{{ old($field, $profile->$field) }}</textarea>
      @else
        <input type="text" id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $profile->$field) }}"
          class="form-control @error($field) is-invalid @enderror">
      @endif
      @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
  @endforeach

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label" for="instagram">Instagram (URL lengkap)</label>
      <input type="text" id="instagram" name="instagram"
        value="{{ old('instagram', $bersih($sosial['instagram'] ?? '')) }}"
        class="form-control @error('instagram') is-invalid @enderror" placeholder="https://instagram.com/...">
      @error('instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label" for="youtube">YouTube (URL lengkap)</label>
      <input type="text" id="youtube" name="youtube"
        value="{{ old('youtube', $bersih($sosial['youtube'] ?? '')) }}"
        class="form-control @error('youtube') is-invalid @enderror" placeholder="https://youtube.com/...">
      @error('youtube')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
  </div>

  <button class="btn btn-gold">Simpan</button>
</form>
@endsection