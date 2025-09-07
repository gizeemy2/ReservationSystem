@extends('admin.layout') {{-- basit bir layout önerdim; yoksa <html> tam sayfa yazabilirim --}}

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h5 mb-0">Müşteriler</h2>
  <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg me-1"></i> Yeni Müşteri
  </a>
</div>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="GET" class="mb-3">
  <div class="input-group">
    <span class="input-group-text"><i class="bi bi-search"></i></span>
    <input type="text" name="q" class="form-control" value="{{ $q }}" placeholder="Ad, soyad, e-posta, telefon">
    <button class="btn btn-outline-secondary" type="submit">Ara</button>
  </div>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Ad Soyad</th>
          <th>E-posta</th>
          <th>Telefon</th>
          <th>Segment</th>
          <th class="text-end">İşlem</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($customers as $c)
          <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->first_name }} {{ $c->last_name }}</td>
            <td>{{ $c->email ?? '—' }}</td>
            <td>{{ $c->phone ?? '—' }}</td>
            <td><span class="badge text-bg-secondary">{{ $c->segment }}</span></td>
            <td class="text-end">
              <a href="{{ route('admin.customers.edit', $c) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('admin.customers.destroy', $c) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Silinsin mi?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted py-4">Kayıt bulunamadı.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">
  {{ $customers->links() }}
</div>
@endsection
