@extends('admin.layout')

@section('title', 'Rezervasyon Düzenle')
@section('page_title', 'Rezervasyon #'.$reservation->id)

@section('content')
<form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="row g-3">
    @csrf @method('PUT')

    <div class="col-md-6">
        <label class="form-label">Müşteri</label>
        <select name="customer_id" class="form-select" required>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $reservation->customer_id) == $customer->id)>
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option value="pending" @selected(old('status', $reservation->status) == 'pending')>Beklemede</option>
            <option value="confirmed" @selected(old('status', $reservation->status) == 'confirmed')>Onaylandı</option>
            <option value="cancelled" @selected(old('status', $reservation->status) == 'cancelled')>İptal</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Başlangıç Tarihi</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $reservation->start_date) }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Bitiş Tarihi</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $reservation->end_date) }}">
    </div>

    <div class="col-md-12">
        <label class="form-label">Not</label>
        <textarea name="note" class="form-control" rows="3">{{ old('note', $reservation->note) }}</textarea>
    </div>

    <div class="col-12 d-flex gap-2">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">Geri</a>
        <button class="btn btn-primary">Güncelle</button>
    </div>
</form>
@endsection
