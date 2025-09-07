{{-- resources/views/admin/suppliers/create.blade.php --}}
@extends('admin.layout')

@section('title','Yeni Tedarikçi')
@section('page_title','Yeni Tedarikçi')

@section('content')
<form method="POST" action="{{ route('admin.suppliers.store') }}" class="row g-3">
  @csrf
  <div class="col-md-6">
    <label class="form-label">Ad</label>
    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">E-posta</label>
    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">Telefon</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
  </div>
  <div class="col-12 d-flex gap-2">
    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-outline-secondary">İptal</a>
    <button type="submit" class="btn btn-primary">Kaydet</button>
  </div>
</form>
@endsection
