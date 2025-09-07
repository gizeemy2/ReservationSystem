<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>

  {{-- Bootstrap 5 + Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --sidebar-w: 260px;
      --sidebar-bg: #0f172a;     /* slate-900 */
      --sidebar-fg: #e2e8f0;     /* slate-200 */
      --sidebar-muted: #94a3b8;  /* slate-400 */
      --brand-grad: linear-gradient(135deg,#6366f1,#22d3ee);
    }
    html,body{height:100%}
    body{background:#f8fafc}
    .layout{min-height:100vh; display:flex}

    /* Sidebar */
    .sidebar{
      width: var(--sidebar-w);
      background: var(--sidebar-bg);
      color: var(--sidebar-fg);
      position: sticky; top:0; height:100vh;
      display:flex; flex-direction:column; gap:.5rem;
    }
    .brand{
      display:flex; align-items:center; gap:.6rem;
      padding:1rem 1.25rem; border-bottom:1px solid rgba(255,255,255,.06);
    }
    .brand .logo{
      width:36px; height:36px; border-radius:10px;
      background: var(--brand-grad); color:#fff; display:grid; place-items:center; font-weight:700;
      box-shadow: 0 8px 22px rgba(99,102,241,.35);
    }
    .nav-link{
      color: var(--sidebar-fg); opacity:.9; border-radius:.6rem; padding:.6rem .85rem;
      display:flex; align-items:center; gap:.6rem; font-weight:500;
    }
    .nav-link .bi{font-size:1.05rem}
    .nav-link:hover{background:rgba(255,255,255,.06); color:#fff}
    .nav-link.active{background:rgba(255,255,255,.12); color:#fff}
    .nav-section{padding:.75rem 1.25rem .25rem; color:var(--sidebar-muted); font-size:.8rem; text-transform:uppercase; letter-spacing:.04em}

    /* Content */
    .content{
      flex:1; min-width:0; display:flex; flex-direction:column;
    }
    .topbar{
      background:#ffffff; border-bottom:1px solid #e2e8f0; padding:.6rem 1rem;
      display:flex; align-items:center; justify-content:space-between; gap:1rem;
      position:sticky; top:0; z-index:10;
    }
    .btn-grad{
      background: var(--brand-grad); color:#fff; border:0;
      box-shadow: 0 8px 18px rgba(99,102,241,.25);
    }
    .btn-grad:hover{filter:brightness(.95)}
    .search{max-width:420px}
    .stat-card .bi{font-size:1.4rem}
    .table thead th{font-size:.8rem; text-transform:uppercase; color:#64748b; border-bottom-color:#e2e8f0}
    .muted{color:#64748b}

    /* Mobile sidebar */
    @media (max-width: 992px){
      .sidebar{position:fixed; left:0; top:0; bottom:0; transform:translateX(-100%); transition:.25s ease;}
      .sidebar.show{transform:translateX(0)}
      .backdrop{position:fixed; inset:0; background:rgba(0,0,0,.35); display:none; z-index:9;}
      .backdrop.show{display:block}
      .content{margin-left:0}
    }
  </style>
</head>
<body>

<div class="layout">
  {{-- SIDEBAR --}}
  <aside id="sidebar" class="sidebar">
    <div class="brand">
      <div class="logo">A</div>
      <div>
        <div class="fw-semibold">Admin Panel</div>
        <div class="small" style="color:#94a3b8">
            {{ auth()->user()->name ?? 'Yönetici' }}
          </div>
    </div>
    </div>

    <div class="px-3 mt-2">
      <a class="nav-link active" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
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

    <div class="nav-section">Ayarlar</div>
    <div class="px-3 mb-3">
      <a class="nav-link" href="#"><i class="bi bi-gear"></i> Sistem</a>
      <a class="nav-link" href="#"><i class="bi bi-shield-lock"></i> Güvenlik</a>
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

  {{-- MOBILE BACKDROP --}}
  <div id="backdrop" class="backdrop" onclick="toggleSidebar(false)"></div>

  {{-- CONTENT --}}
  <section class="content">
    {{-- TOP BAR --}}
    <div class="topbar">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-secondary d-lg-none" onclick="toggleSidebar(true)">
          <i class="bi bi-list"></i>
        </button>
        <h1 class="h5 mb-0">Dashboard</h1>
      </div>

      <form class="d-none d-md-flex search w-100">
        <div class="input-group">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input type="text" class="form-control" placeholder="Ara...">
        </div>
      </form>

      <div class="d-flex align-items-center gap-2">
        <span class="muted d-none d-sm-inline">Merhaba, {{ auth()->user()->name ?? 'Yönetici' }}</span>
        <span class="badge text-bg-primary">v1.0</span>
      </div>
    </div>

    {{-- MAIN --}}
    <main class="container-fluid py-4">
      {{-- Stats --}}
      <div class="row g-3">
        <div class="col-12 col-md-6 col-xl-3">
          <div class="card shadow-sm border-0 rounded-4 stat-card">
            <div class="card-body d-flex align-items-center gap-3">
              <span class="btn btn-light rounded-3"><i class="bi bi-people"></i></span>
              <div>
                <div class="small muted">Toplam Müşteri</div>
                <div class="fs-4 fw-semibold">1,248</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <div class="card shadow-sm border-0 rounded-4 stat-card">
            <div class="card-body d-flex align-items-center gap-3">
              <span class="btn btn-light rounded-3"><i class="bi bi-card-checklist"></i></span>
              <div>
                <div class="small muted">Aktif Rezervasyon</div>
                <div class="fs-4 fw-semibold">86</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <div class="card shadow-sm border-0 rounded-4 stat-card">
            <div class="card-body d-flex align-items-center gap-3">
              <span class="btn btn-light rounded-3"><i class="bi bi-cash-coin"></i></span>
              <div>
                <div class="small muted">Aylık Gelir (USD)</div>
                <div class="fs-4 fw-semibold">$12,430</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <div class="card shadow-sm border-0 rounded-4 stat-card">
            <div class="card-body d-flex align-items-center gap-3">
              <span class="btn btn-light rounded-3"><i class="bi bi-activity"></i></span>
              <div>
                <div class="small muted">Dönüşüm</div>
                <div class="fs-4 fw-semibold">4.3%</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Quick actions --}}
      <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-body d-flex flex-wrap gap-2">
          <a href="#" class="btn btn-grad"><i class="bi bi-plus-lg me-1"></i> Yeni Rezervasyon</a>
          <a href="#" class="btn btn-outline-primary"><i class="bi bi-upload me-1"></i> Dosya Yükle</a>
          <a href="#" class="btn btn-outline-secondary"><i class="bi bi-download me-1"></i> İndir</a>
        </div>
      </div>

      {{-- Latest reservations (table demo) --}}
      <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-header bg-white d-flex align-items-center justify-content-between">
          <span class="fw-semibold">Son Rezervasyonlar</span>
          <a href="#" class="btn btn-sm btn-outline-secondary">Tümünü Gör</a>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>Müşteri</th>
                <th>Tür</th>
                <th>Tarih</th>
                <th>Tutar (USD)</th>
                <th class="text-end">Durum</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>RSV-1024</td>
                <td>Jane Cooper</td>
                <td>Hotel</td>
                <td>2025-09-06</td>
                <td>1,120</td>
                <td class="text-end"><span class="badge text-bg-success">Onaylandı</span></td>
              </tr>
              <tr>
                <td>RSV-1023</td>
                <td>Wade Warren</td>
                <td>Flight</td>
                <td>2025-09-05</td>
                <td>780</td>
                <td class="text-end"><span class="badge text-bg-warning">Beklemede</span></td>
              </tr>
              <tr>
                <td>RSV-1022</td>
                <td>Jacob Jones</td>
                <td>Tour</td>
                <td>2025-09-04</td>
                <td>340</td>
                <td class="text-end"><span class="badge text-bg-secondary">Taslak</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </main>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const sidebar = document.getElementById('sidebar');
  const backdrop = document.getElementById('backdrop');
  function toggleSidebar(show){
    if(show){
      sidebar.classList.add('show'); backdrop.classList.add('show');
    }else{
      sidebar.classList.remove('show'); backdrop.classList.remove('show');
    }
  }
</script>
</body>
</html>
