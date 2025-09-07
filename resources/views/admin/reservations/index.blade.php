@extends('admin.layout')

@section('title', 'Rezervasyonlar')
@section('page_title', 'Tüm Rezervasyonlar')

@section('content')
<div class="mb-3 d-flex justify-content-between">
    <a href="{{ route('admin.reservations.create') }}" class="btn btn-primary">+ Yeni Rezervasyon</a>

    <form method="GET" action="{{ route('admin.reservations.index') }}" class="d-flex" style="max-width: 300px;">
        <input type="text" name="q" class="form-control me-2" placeholder="Ara..." value="{{ request('q') }}">
        <button class="btn btn-outline-secondary">Ara</button>
    </form>
</div>

@if($reservations->count())
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Müşteri</th>
            <th>Durum</th>
            <th>Başlangıç</th>
            <th>Bitiş</th>
            <th>Oluşturulma</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
        <tr>
            <td>#{{ $reservation->id }}</td>
            <td>{{ $reservation->customer->first_name }} {{ $reservation->customer->last_name }}</td>
            <td>
                <span class="badge bg-{{ $reservation->status == 'confirmed' ? 'success' : ($reservation->status == 'pending' ? 'warning' : 'secondary') }}">
                    {{ ucfirst($reservation->status) }}
                </span>
            </td>
            <td>{{ $reservation->start_date }}</td>
            <td>{{ $reservation->end_date }}</td>
            <td>{{ $reservation->created_at->format('d.m.Y H:i') }}</td>
            <td class="text-end">
                <a href="{{ route('admin.reservations.edit', $reservation) }}" class="btn btn-sm btn-warning">Düzenle</a>
                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Sil</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $reservations->links() }}

@else
<div class="alert alert-info">Henüz rezervasyon bulunmuyor.</div>
@endif
@endsection
