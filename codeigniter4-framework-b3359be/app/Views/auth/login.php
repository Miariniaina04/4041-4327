<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitSpace — Gestionnaire de réservations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet" />
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet"/>
</head>

<body>

<!-- ╔══════════════════════════════════════════════════════════╗ -->
<!-- ║  PAGE 3 — CONNEXION (auth/login.php)                     ║ -->
<!-- ╚══════════════════════════════════════════════════════════╝ -->

<section id="page-login" style="background:var(--surface); min-height:100vh; display:flex; flex-direction:column;">

  <nav class="nav-public">
    <a href="<?= base_url('/') ?>" class="brand">Fit<span>Space</span></a>
  </nav>

  <div class="auth-wrapper">
    <div class="auth-card">

      <div class="auth-logo">Fit<span>Space</span></div>
      <p class="auth-subtitle">Content de vous revoir !</p>

    <form id="loginForm" data-url="<?= base_url('/login') ?>" method="post">
      <?= csrf_field() ?> 

      <div id="js-error-message" class="flash-message flash-error" style="display:none; margin-bottom:15px;">
        <i class="bi bi-exclamation-circle-fill"></i>
        <span class="msg-content"></span>
      </div>

      <div class="form-group mb-3">
        <label class="form-label">telephone</label>
        <input type="text" name="telephone" class="form-control" placeholder="0337208662" />
      </div>

      <button type="submit" class="btn-primary-custom">Se connecter</button>
    </form>


    </div>
  </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/app.js"></script>

</body>
</html>
