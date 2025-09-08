@extends('admin.layout')

@section('content')
<h2 class="h5 mb-3">Yeni Müşteri</h2>

@if ($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('admin.customers.store') }}" class="row g-3">
  @csrf
  <div class="col-md-6">
    <label class="form-label">Ad</label>
    <input type="text" name="first_name" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Soyad</label>
    <input type="text" name="last_name" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">E-posta</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Telefon</label>
    <input type="text" name="phone" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Cinsiyet</label>
    <select name="gender" class="form-select">
      <option value="">Seçiniz</option>
      <option value="male">Erkek</option>
      <option value="female">Kadın</option>
      <option value="other">Diğer</option>
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Segment</label>
    <@php $segments = ['GZM STANDART' => 'Standart', 'GZM PREMIUM' => 'Premium']; @endphp
    <select name="segment" class="form-select" required>
      @foreach ($segments as $val => $label)
        <option value="{{ $val }}" @selected(old('segment', $customer->segment ?? '') == $val)>{{ $label }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Doğum Tarihi</label>
    <input type="date" name="dob" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Ülke</label>
    <input type="text" name="country" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">TC No</label>
    <input type="text" name="tc_no" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Pasaport No</label>
    <input type="text" name="passport_no" class="form-control">
  </div>

  <div class="col-12 d-flex gap-2">
    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">İptal</a>
    <button class="btn btn-primary">Kaydet</button>
  </div>
</form>
@endsection
