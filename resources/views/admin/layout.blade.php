<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Admin Panel')</title>

  {{-- Bootstrap 5 + Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{--sidebar-w:260px;--sidebar-bg:#0f172a;--sidebar-fg:#e2e8f0;--sidebar-muted:#94a3b8;--brand-grad:linear-gradient(135deg,#6366f1,#22d3ee);}
    html,body{height:100%} body{background:#f8fafc}
    .layout{min-height:100vh;display:flex}
    .sidebar{width:var(--sidebar-w);background:var(--sidebar-bg);color:var(--sidebar-fg);position:sticky;top:0;height:100vh;display:flex;flex-direction:column;gap:.5rem}
    .brand{display:flex;align-items:center;gap:.6rem;padding:1rem 1.25rem;border-bottom:1px solid rgba(255,255,255,.06)}
    .brand .logo{width:36px;height:36px;border-radius:10px;background:var(--brand-grad);color:#fff;display:grid;place-items:center;font-weight:700;box-shadow:0 8px 22px rgba(99,102,241,.35)}
    .nav-link{color:var(--sidebar-fg);opacity:.9;border-radius:.6rem;padding:.6rem .85rem;display:flex;align-items:center;gap:.6rem;font-weight:500}
    .nav-link:hover{background:rgba(255,255,255,.06);color:#fff}
    .nav-link.active{background:rgba(255,255,255,.12);color:#fff}
    .nav-section{padding:.75rem 1.25rem .25rem;color:var(--sidebar-muted);font-size:.8rem;text-transform:uppercase;letter-spacing:.04em}
    .content{flex:1;min-width:0;display:flex;flex-direction:column}
    .topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:.6rem 1rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;position:sticky;top:0;z-index:10}
    .muted{color:#64748b}
  </style>

  @stack('styles')
</head>
<body>

<div class="layout">
  {{-- SIDEBAR --}}
  <aside class="sidebar">
    <div class="brand">
      <div class="logo">A</div>
      <div>
        <div class="fw-semibold">Admin Panel</div>
        <div class="small" style="color:#94a3b8">{{ auth()->user()->name ?? 'Yönetici' }}</div>
      </div>
    </div>

    <div class="px-3 mt-2">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>
      <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
        <i class="bi bi-people"></i> Müşteriler
      </a>
      <a class="nav-link {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}" href="{{ route('admin.suppliers.index') }}">
        <i class="bi bi-building"></i> Tedarikçiler
      </a>
      <a class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}" href="{{ route('admin.reservations.index') }}">
        <i class="bi bi-card-checklist"></i> Rezervasyonlar
      </a>
      <a class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
        <i class="bi bi-receipt"></i> Ödemeler
      </a>
    </div>

    <div class="mt-auto p-3">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-light w-100">
          <i class="bi bi-box-arrow-right me-1"></i> Çıkış
        </button>
      </form>
    </div>
  </aside>

  {{-- CONTENT --}}
  <section class="content">
    <div class="topbar">
      <h1 class="h6 mb-0">@yield('page_title','Panel')</h1>
      <div class="d-flex align-items-center gap-2">
        <span class="muted d-none d-sm-inline">Merhaba, <strong>{{ auth()->user()->name ?? 'Kullanıcı' }}</strong></span>
      </div>
    </div>

    <main class="container-fluid py-4">
      @yield('content')
    </main>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
