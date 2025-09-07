@extends('admin.layout')

@section('title', 'Ödemeler')
@section('page_title', 'Ödeme Listesi')

@section('content')
<a href="{{ route('admin.payments.create') }}" class="btn btn-primary mb-3">Yeni Ödeme</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Rezervasyon</th>
            <th>Miktar</th>
            <th>Yöntem</th>
            <th>Not</th>
            <th>Tarih</th>
            <th>İşlem</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->reservation->id }}</td>
                <td>${{ $payment->amount_usd }}</td>
                <td>{{ $payment->method }}</td>
                <td>{{ $payment->note }}</td>
                <td>{{ $payment->created_at->format('d.m.Y') }}</td>
                <td>
                    <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-sm btn-warning">Düzenle</a>
                    <form method="POST" action="{{ route('admin.payments.destroy', $payment) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
