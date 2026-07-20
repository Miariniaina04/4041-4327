<!-- ╔══════════════════════════════════════════════════════════╗ -->
<!-- ║  PAGE 3 — CONNEXION (auth/login.php)                     ║ -->
<!-- ╚══════════════════════════════════════════════════════════╝ -->

<section id="page-login" style="background:var(--surface); min-height:100vh; display:flex; flex-direction:column;">


  <div class="auth-wrapper">
    <div class="auth-card">
    <form id="loginForm" action="<?= base_url('/login') ?>" data-url="<?= base_url('/login') ?>" method="post">
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

