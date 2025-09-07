<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Giriş</title>

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Bootstrap Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --card-w: 420px;
    }
    body {
      height: 100vh;
      background: radial-gradient(1200px 600px at 10% -10%, #eef4ff 0%, transparent 60%),
                  radial-gradient(1000px 800px at 110% 10%, #f8f9ff 0%, transparent 60%),
                  #0f172a;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    .auth-card {
      width: min(100%, var(--card-w));
      border: 1px solid rgba(255,255,255,.08);
      backdrop-filter: blur(6px);
      background: rgba(255,255,255,.06);
    }
    .auth-card .form-control {
      background: rgba(255,255,255,.9);
    }
    .brand {
      display:flex; gap:.6rem; align-items:center; justify-content:center;
      color:#fff;
      margin-bottom: 1rem;
    }
    .brand .logo {
      width:36px; height:36px; border-radius:10px;
      background: linear-gradient(135deg,#6366f1,#22d3ee);
      display:grid; place-items:center; color:#fff; font-weight:700;
      box-shadow: 0 10px 25px rgba(99,102,241,.35);
    }
    .muted { color: #cbd5e1; }
    .footer-cta { color:#94a3b8; font-size:.9rem; }
    .btn-gradient {
      background: linear-gradient(135deg,#6366f1,#22d3ee);
      border: 0;
      color: #fff;
      box-shadow: 0 10px 20px rgba(99,102,241,.35);
    }
    .btn-gradient:hover { filter: brightness(0.95); }
  </style>
</head>
<body>

  <main class="w-100">
    <div class="text-center brand">
      <div class="logo">A</div>
      <div>
        <div class="fw-semibold">Admin Panel</div>
        <div class="small muted">Güvenli giriş</div>
      </div>
    </div>

    <div class="card shadow-lg auth-card rounded-4 overflow-hidden mx-auto">
      <div class="card-body p-4 p-sm-5 bg-white">
        <h1 class="h4 mb-1">Hoş geldin 👋</h1>
        <p class="text-secondary mb-4">Lütfen e-posta ve şifrenle giriş yap.</p>

        @if ($errors->any())
          <div class="alert alert-danger d-flex align-items-start" role="alert">
            <i class="bi bi-exclamation-triangle me-2 fs-5"></i>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="needs-validation" novalidate>
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">E-posta</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
              <input id="email" type="email" name="email" class="form-control" required placeholder="ornek@site.com">
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input id="password" type="password" name="password" class="form-control" required placeholder="••••••••">
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
            <label class="form-check-label" for="remember">Beni hatırla</label>
          </div>

          <button type="submit" class="btn btn-gradient w-100 py-2">
            <i class="bi bi-box-arrow-in-right me-1"></i> Giriş Yap
          </button>
        </form>

        <div class="text-center mt-4 footer-cta">
          <i class="bi bi-shield-lock"></i> Oturum güvenliği aktif.
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Şifre göster/gizle
    document.getElementById('togglePassword').addEventListener('click', function () {
      const input = document.getElementById('password');
      const isPass = input.getAttribute('type') === 'password';
      input.setAttribute('type', isPass ? 'text' : 'password');
      this.firstElementChild.classList.toggle('bi-eye');
      this.firstElementChild.classList.toggle('bi-eye-slash');
    });
  </script>
</body>
</html>
