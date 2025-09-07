@extends('admin.layout')

@section('title','Tedarikçiler')
@section('page_title','Tedarikçiler')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h5 mb-0">Tedarikçiler</h2>
    <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Yeni Tedarikçi
    </a>
</div>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

{{-- Arama --}}
<form method="GET" class="mb-3">
  <div class="input-group">
    <span class="input-group-text"><i class="bi bi-search"></i></span>
    <input type="text" name="q" class="form-control" value="{{ $q ?? '' }}" placeholder="İsim, e-posta veya telefon ara...">
    <button class="btn btn-outline-secondary" type="submit">Ara</button>
  </div>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Ad</th>
          <th>E-posta</th>
          <th>Telefon</th>
          <th class="text-end">İşlem</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($suppliers as $supplier)
          <tr>
            <td>{{ $supplier->id }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->email ?? '—' }}</td>
            <td>{{ $supplier->phone ?? '—' }}</td>
            <td class="text-end">
              <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted py-4">Hiç tedarikçi bulunamadı.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">
  {{ $suppliers->links() }}
</div>
@endsection
