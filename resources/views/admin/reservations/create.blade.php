@extends('admin.layout')

@section('title', 'Yeni Rezervasyon')
@section('page_title', 'Yeni Rezervasyon Oluştur')

@section('content')
<form method="POST" action="{{ route('admin.reservations.store') }}" class="row g-4">
    @csrf

    <!-- MÜŞTERİ BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2">👤 Müşteri Bilgileri</h5>
    </div>
    <div class="col-md-4">
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
    <div class="col-md-2">
        <label class="form-label">Kişi Sayısı</label>
        <input type="number" name="person_count" class="form-control" value="{{ old('person_count', 1) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Segment</label>
        <select name="segment" class="form-select">
            <option value="GZM STANDART">GZM STANDART</option>
            <option value="GZM PREMIUM">GZM PREMIUM</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">TC No</label>
        <input type="text" name="identity_number" class="form-control">
    </div>

    <!-- OTEL BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">🏨 Otel Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">Otel Adı</label>
        <input type="text" name="hotel_name" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label">Giriş</label>
        <input type="date" name="start_date" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label">Çıkış</label>
        <input type="date" name="end_date" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label">Gece</label>
        <input type="number" name="night_count" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label">Oda Tipi</label>
        <input type="text" name="room_type" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Ücret (USD)</label>
        <input type="number" step="0.01" name="hotel_price" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Tedarikçi</label>
        <input type="text" name="hotel_supplier" class="form-control">
    </div>

    <!-- UÇAK BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">✈️ Uçak Bilgileri</h5>
    </div>
    <div class="col-md-3">
        <label class="form-label">Gidiş</label>
        <input type="datetime-local" name="flight_departure" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Dönüş</label>
        <input type="datetime-local" name="flight_return" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Havayolu</label>
        <input type="text" name="airline" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">PNR</label>
        <input type="text" name="pnr" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label">Bagaj</label>
        <input type="text" name="baggage" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label">Ücret (USD)</label>
        <input type="number" step="0.01" name="flight_price" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Tedarikçi</label>
        <input type="text" name="flight_supplier" class="form-control">
    </div>
    <!-- TRANSFER, SİGORTA, ESIM -->



        <!-- PASAPORT VE ÜLKE -->
    <div class="col-md-3">
        <label class="form-label">Pasaport No</label>
        <input type="text" name="passport_no" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Ülke</label>
        <input type="text" name="country" class="form-control">
    </div>

    <!-- OTEL NOTU -->
    <div class="col-md-12">
        <label class="form-label">Otel Notu</label>
        <textarea name="hotel_note" class="form-control" rows="2"></textarea>
    </div>

    <!-- TRANSFER BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">🚐 Transfer Bilgileri</h5>
    </div>
    <div class="col-md-3">
        <label class="form-label">Transfer Tarihi</label>
        <input type="datetime-local" name="transfer_date" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Yön</label>
        <select name="transfer_direction" class="form-select">
            <option value="Gidiş">Gidiş</option>
            <option value="Dönüş">Dönüş</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Transfer Ücreti (USD)</label>
        <input type="number" step="0.01" name="transfer_price" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Tedarikçi</label>
        <input type="text" name="transfer_supplier" class="form-control">
    </div>

    <!-- SİGORTA BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">🛡️ Sigorta Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">Sigorta Tipi</label>
        <input type="text" name="insurance_type" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Sigorta Ücreti (USD)</label>
        <input type="number" step="0.01" name="insurance_price" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Sigorta Tedarikçisi</label>
        <input type="text" name="insurance_supplier" class="form-control">
    </div>

    <!-- ESIM BİLGİLERİ -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">📶 eSIM Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">eSIM Paketi</label>
        <input type="text" name="esim_package" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">eSIM Ücreti (USD)</label>
        <input type="number" step="0.01" name="esim_price" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">eSIM Tedarikçisi</label>
        <input type="text" name="esim_supplier" class="form-control">
    </div>

    <!-- TOPLAM FİYATLANDIRMA -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mt-4">💰 Ödeme Bilgileri</h5>
    </div>
    <div class="col-md-4">
        <label class="form-label">Hizmet Bedeli (USD)</label>
        <input type="number" step="0.01" name="service_fee_usd" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Toplam Tutar (USD)</label>
        <input type="number" step="0.01" name="total_usd" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Kur (USD → TRY)</label>
        <input type="number" step="0.0001" name="usd_to_try_rate" class="form-control">
    </div>

    <div class="col-md-3">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select" required>
            <option value="pending" @selected(old('status') == 'pending')>Beklemede</option>
            <option value="confirmed" @selected(old('status') == 'confirmed')>Onaylandı</option>
            <option value="cancelled" @selected(old('status') == 'cancelled')>İptal</option>
        </select>
    </div>
    
    <div class="col-md-12 mt-4">
        <label class="form-label">Not</label>
        <textarea name="note" class="form-control" rows="3"></textarea>
    </div>

    <div class="col-12 d-flex justify-content-end mt-3">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">İptal</a>
        <button class="btn btn-primary">Kaydet</button>
    </div>
</form>

@endsection
