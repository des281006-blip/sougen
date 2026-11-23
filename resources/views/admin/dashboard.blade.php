@extends('layouts.admin')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
<div class="row g-3">
  <div class="col-md-4">
    <div class="sg-card p-3"><small>Total Event</small><div class="display-6">{{ $totalEvents }}</div></div>
  </div>
  <div class="col-md-4">
    <div class="sg-card p-3"><small>Event Mendatang</small><div class="display-6">{{ $upcomingEvents }}</div></div>
  </div>
  <div class="col-md-4">
    <div class="sg-card p-3"><small>Pengguna Terdaftar</small><div class="display-6">{{ $totalUsers }}</div></div>
  </div>
</div>
<p class="text-muted mt-4 small">
  Ringkasan transaksi dan pendapatan ditambahkan pada Batch E, setelah fitur pemesanan dan pembayaran dibuat.
</p>
@endsection