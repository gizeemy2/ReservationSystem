@extends('admin.layout')

@section('title', 'Yeni Rezervasyon')
@section('page_title', 'Yeni Rezervasyon Oluştur')

@section('content')
<form method="POST" action="{{ route('admin.reservations.store') }}" class="row g-3">
    @csrf

    <div class="col-md-6">
        <label class="form-label">Müşteri</label>
        <select name="customer_id" class="form-select" required>
            <option value="">Seçiniz</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option value="pending" @selected(old('status') == 'pending')>Beklemede</option>
            <option value="confirmed" @selected(old('status') == 'confirmed')>Onaylandı</option>
            <option value="cancelled" @selected(old('status') == 'cancelled')>İptal</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Başlangıç Tarihi</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Bitiş Tarihi</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
    </div>

    <div class="col-md-12">
        <label class="form-label">Not</label>
        <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
    </div>

    <div class="col-12 d-flex gap-2">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">İptal</a>
        <button class="btn btn-primary">Kaydet</button>
    </div>
</form>
@endsection
