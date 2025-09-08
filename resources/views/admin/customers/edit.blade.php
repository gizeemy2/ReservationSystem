@extends('admin.layout')

@section('content')
<h2 class="h5 mb-3">Müşteri Düzenle #{{ $customer->id }}</h2>

@if ($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('admin.customers.update',$customer) }}" class="row g-3">
  @csrf @method('PUT')
  <div class="col-md-6">
    <label class="form-label">Ad</label>
    <input type="text" name="first_name" value="{{ old('first_name',$customer->first_name) }}" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Soyad</label>
    <input type="text" name="last_name" value="{{ old('last_name',$customer->last_name) }}" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">E-posta</label>
    <input type="email" name="email" value="{{ old('email',$customer->email) }}" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Telefon</label>
    <input type="text" name="phone" value="{{ old('phone',$customer->phone) }}" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Cinsiyet</label>
    <select name="gender" class="form-select">
      <option value="">Seçiniz</option>
      @foreach (['male'=>'Erkek','female'=>'Kadın','other'=>'Diğer'] as $val=>$label)
        <option value="{{ $val }}" @selected(old('gender',$customer->gender)==$val)>{{ $label }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Segment</label>
    @php $segments = ['GZM STANDART' => 'Standart', 'GZM PREMIUM' => 'Premium']; @endphp

    <select name="segment" class="form-select" required>
      @foreach ($segments as $val => $label)
        <option value="{{ $val }}" @selected(old('segment', $customer->segment ?? '') == $val)>{{ $label }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Doğum Tarihi</label>
    <input type="date" name="dob" value="{{ old('dob',$customer->dob) }}" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Ülke</label>
    <input type="text" name="country" value="{{ old('country',$customer->country) }}" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">TC No</label>
    <input type="text" name="tc_no" value="{{ old('tc_no',$customer->tc_no) }}" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Pasaport No</label>
    <input type="text" name="passport_no" value="{{ old('passport_no',$customer->passport_no) }}" class="form-control">
  </div>

  <div class="col-12 d-flex gap-2">
    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Geri</a>
    <button class="btn btn-primary">Güncelle</button>
  </div>
</form>
@endsection
