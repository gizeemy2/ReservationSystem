@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Yeni Ödeme Ekle</h2>

    <form action="{{ route('admin.payments.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="customer_id" class="form-label">Müşteri</label>
                <select name="customer_id" id="customer_id" class="form-select" required>
                    <option value="">Seçiniz</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="reservation_id" class="form-label">Rezervasyon</label>
                <select name="reservation_id" id="reservation_id" class="form-select" required>
                    <option value="">Seçiniz</option>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}">
                            {{ $reservation->code ?? 'Rezervasyon #' . $reservation->id }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="amount" class="form-label">Tutar</label>
                <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label for="currency" class="form-label">Para Birimi</label>
                <select name="currency" id="currency" class="form-select" required>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="TRY">TRY</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="payment_date" class="form-label">Ödeme Tarihi</label>
                <input type="date" name="payment_date" id="payment_date" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notlar</label>
            <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="İsteğe bağlı..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection
