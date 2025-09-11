@extends('admin.layout')

@section('title', 'Rezervasyon Düzenle')
@section('page_title', 'Rezervasyon #'.$reservation->id)

@section('content')
<form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="row g-4">
    @csrf
    @method('PUT')

    <!-- MÜŞTERİ BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2">👤 Müşteri Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">Müşteri</label>
        <select name="customer_id" class="form-select" required>
            <option value="">Seçiniz</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $reservation->customer_id) == $customer->id)>
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">Kişi Sayısı</label>
        <input type="number" name="person_count" class="form-control" value="{{ old('person_count', $reservation->guest_count) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Segment</label>
        <select name="segment" class="form-select">
            <option value="GZM STANDART" @selected(old('segment', $reservation->segment) == 'GZM STANDART')>GZM STANDART</option>
            <option value="GZM PREMIUM" @selected(old('segment', $reservation->segment) == 'GZM PREMIUM')>GZM PREMIUM</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">TC No</label>
        <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', $reservation->identity_number) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Pasaport No</label>
        <input type="text" name="passport_no" class="form-control" value="{{ old('passport_no', $reservation->passport_no) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Ülke</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $reservation->country) }}">
    </div>

    <!-- OTEL BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">🏨 Otel Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">Otel Adı</label>
        <input type="text" name="hotel_name" class="form-control" value="{{ old('hotel_name', $reservation->hotel_name) }}">
    </div>
    <div class="col-md-2">
        <label class="form-label">Giriş</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $reservation->start_date) }}">
    </div>
    <div class="col-md-2">
        <label class="form-label">Çıkış</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $reservation->end_date) }}">
    </div>
    <div class="col-md-2">
        <label class="form-label">Gece</label>
        <input type="number" name="night_count" class="form-control" value="{{ old('night_count', $reservation->night_count) }}">
    </div>
    <div class="col-md-2">
        <label class="form-label">Oda Tipi</label>
        <input type="text" name="room_type" class="form-control" value="{{ old('room_type', $reservation->room_type) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Ücret (USD)</label>
        <input type="number" step="0.01" name="hotel_price" class="form-control" value="{{ old('hotel_price', $reservation->hotel_price) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Tedarikçi</label>
        <input type="text" name="hotel_supplier" class="form-control" value="{{ old('hotel_supplier', $reservation->hotel_supplier) }}">
    </div>
    <div class="col-md-12">
        <label class="form-label">Otel Notu</label>
        <textarea name="hotel_note" class="form-control" rows="2">{{ old('hotel_note', $reservation->hotel_note) }}</textarea>
    </div>

    <!-- UÇAK BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">✈️ Uçak Bilgileri</h5>
    </div>
    <div class="col-md-3">
        <label class="form-label">Gidiş</label>
        <input type="datetime-local" name="flight_departure" class="form-control" value="{{ old('flight_departure', $reservation->flight_departure) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Dönüş</label>
        <input type="datetime-local" name="flight_return" class="form-control" value="{{ old('flight_return', $reservation->flight_return) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Havayolu</label>
        <input type="text" name="airline" class="form-control" value="{{ old('airline', $reservation->airline) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">PNR</label>
        <input type="text" name="pnr" class="form-control" value="{{ old('pnr', $reservation->pnr) }}">
    </div>
    <div class="col-md-2">
        <label class="form-label">Bagaj</label>
        <input type="text" name="baggage" class="form-control" value="{{ old('baggage', $reservation->baggage) }}">
    </div>
    <div class="col-md-2">
        <label class="form-label">Ücret (USD)</label>
        <input type="number" step="0.01" name="flight_price" class="form-control" value="{{ old('flight_price', $reservation->flight_price) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Tedarikçi</label>
        <input type="text" name="flight_supplier" class="form-control" value="{{ old('flight_supplier', $reservation->flight_supplier) }}">
    </div>

    <!-- TRANSFER BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">🚐 Transfer Bilgileri</h5>
    </div>
    <div class="col-md-3">
        <label class="form-label">Transfer Tarihi</label>
        <input type="datetime-local" name="transfer_date" class="form-control" value="{{ old('transfer_date', $reservation->transfer_date) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Yön</label>
        <select name="transfer_direction" class="form-select">
            <option value="Gidiş" @selected(old('transfer_direction', $reservation->transfer_direction) == 'Gidiş')>Gidiş</option>
            <option value="Dönüş" @selected(old('transfer_direction', $reservation->transfer_direction) == 'Dönüş')>Dönüş</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Transfer Ücreti (USD)</label>
        <input type="number" step="0.01" name="transfer_price" class="form-control" value="{{ old('transfer_price', $reservation->transfer_price) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Tedarikçi</label>
        <input type="text" name="transfer_supplier" class="form-control" value="{{ old('transfer_supplier', $reservation->transfer_supplier) }}">
    </div>

    <!-- SİGORTA -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">🛡️ Sigorta Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">Sigorta Tipi</label>
        <input type="text" name="insurance_type" class="form-control" value="{{ old('insurance_type', $reservation->insurance_type) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Sigorta Ücreti (USD)</label>
        <input type="number" step="0.01" name="insurance_price" class="form-control" value="{{ old('insurance_price', $reservation->insurance_price) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Sigorta Tedarikçisi</label>
        <input type="text" name="insurance_supplier" class="form-control" value="{{ old('insurance_supplier', $reservation->insurance_supplier) }}">
    </div>

    <!-- ESIM -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">📶 eSIM Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">eSIM Paketi</label>
        <input type="text" name="esim_package" class="form-control" value="{{ old('esim_package', $reservation->esim_package) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">eSIM Ücreti (USD)</label>
        <input type="number" step="0.01" name="esim_price" class="form-control" value="{{ old('esim_price', $reservation->esim_price) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">eSIM Tedarikçisi</label>
        <input type="text" name="esim_supplier" class="form-control" value="{{ old('esim_supplier', $reservation->esim_supplier) }}">
    </div>

    <!-- ÖDEME BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">💰 Ödeme Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">Hizmet Bedeli (USD)</label>
        <input type="number" step="0.01" name="service_fee_usd" class="form-control" value="{{ old('service_fee_usd', $reservation->service_fee_usd) }}">
    </div>
    
    <div class="col-md-4">
        <label class="form-label">Toplam Tutar (USD)</label>
        <input type="number" step="0.01" name="total_usd" class="form-control" value="{{ old('total_usd', $reservation->total_usd) }}">
    </div>
    
    <div class="col-md-4">
        <label class="form-label">Kur (USD → TRY)</label>
        <input type="number" step="0.0001" name="usd_to_try_rate" class="form-control" value="{{ old('usd_to_try_rate', $reservation->usd_to_try_rate) }}">
    </div>
    
    <div class="col-md-3">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select" required>
            <option value="pending" @selected(old('status', $reservation->status) == 'pending')>Beklemede</option>
            <option value="confirmed" @selected(old('status', $reservation->status) == 'confirmed')>Onaylandı</option>
            <option value="cancelled" @selected(old('status', $reservation->status) == 'cancelled')>İptal</option>
        </select>
    </div>
    <div class="col-md-12 mt-4">
        <label class="form-label">Not</label>
        <textarea name="note" class="form-control" rows="3">{{ old('note', $reservation->note) }}</textarea>
    </div>

    <div class="col-12 d-flex justify-content-end mt-3">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">İptal</a>
        <button class="btn btn-primary">Güncelle</button>
    </div>
</form>
@endsection
