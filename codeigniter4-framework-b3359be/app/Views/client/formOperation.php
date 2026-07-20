<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>formulaire operation</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">

</head>
<body>
  <!-- ╔══════════════════════════════════════════════════════════╗ -->
  <!-- ║  PAGE 3 — CONNEXION (auth/login.php)                     ║ -->
  <!-- ╚══════════════════════════════════════════════════════════╝ -->

  <section id="page-login" class="d-flex align-items-center justify-content-center" style="background-color: var(--bs-body-bg); min-height: 100vh;">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          
          <!-- Carte Néomorphique -->
          <div class="card p-4 border-0" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
              
              <h3 class="card-title text-center mb-4 fw-bold text-primary">Connexion</h3>

              <form id="formOperation" action="<?= base_url('/client/saveOperation/') ?>" data-url="<?= base_url('/client/saveOperation/') ?>" method="post">
                <?= csrf_field() ?> 

                <!-- Message d'erreur personnalisé (compatible Bootstrap alert) -->
                <div id="js-error-message" class="alert alert-danger d-flex align-items-center mb-3" style="display: none !important;">
                  <i class="bi bi-exclamation-circle-fill me-2"></i>
                  <span class="msg-content"></span>
                </div>

                <!-- Champ Téléphone -->
                <div class="form-group mb-4">
                  <label class="form-label fw-semibold">Téléphone</label>
                  <input type="text" name="telephone" class="form-control" placeholder="0337208662" required />
                </div>

                <div class="form-group mb-4">
                  <label class="form-label fw-semibold">Montant</label>
                  <input type="text" name="telephone" class="form-control" placeholder="0337208662" required />
                </div>

                <div>
                <label for="exampleSelect1" class="form-label mt-4">Example select</label>
                    <select class="form-select" id="exampleSelect1">
                        <option>1</option>
                    </select>
                </div>
                <!-- Bouton d'action principal -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </div>

  </section>
  <footer class="footer-public">
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('js/bootstrap.js') ?>"></script>
</body>
</html>