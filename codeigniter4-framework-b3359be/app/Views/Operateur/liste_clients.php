<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Opérateur</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
</head>
<body style="background-color: var(--bs-body-bg); min-height: 100vh;" class="py-4">

  <!-- Tableau des clients -->
  <div class="container" style="max-width: 1000px;">
   
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 text-secondary"><i class="fa fa-users text-primary me-2"></i> Liste des Comptes Clients</h1>
    </div> 
    <!-- En-tête de la page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h1 class="h3 fw-bold text-dark mb-1">
          <i class="bi bi-people-fill text-primary me-2"></i>Liste des Comptes Clients
        </h1>
        <p class="text-muted small mb-0">Aperçu global des numéros inscrits et de leurs soldes respectifs.</p>
      </div>
      <div class="mt-3 mt-md-0">
        <a href="<?= base_url('operateur/client/dashboard') ?>" class="btn btn-sm btn-light border-0 px-3 py-2" style="box-shadow: var(--bs-box-shadow);">
          <i class="bi bi-house-door-fill me-1"></i> Tableau de bord
        </a>
      </div>
    </div>

    <!-- Carte Néomorphique contenant le Tableau -->
    <div class="card border-0 p-3 mb-4" style="box-shadow: var(--bs-box-shadow);">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="ps-4" style="width: 15%;">ID Compte</th>
                <th style="width: 35%;">Numéro de Téléphone</th>
                <th class="text-end" style="width: 25%;">Solde Actuel</th>
                <th class="text-center" style="width: 25%;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $c): ?>
                  <tr>
                    <td class="ps-4 font-monospace text-secondary small">#00<?= esc($c['id']) ?></td>
                    <td>
                      <span class="badge bg-light text-dark font-monospace fs-6 px-3 py-2" style="box-shadow: var(--bs-box-shadow-inset);">
                        <i class="bi bi-telephone-fill me-1 text-primary"></i> <?= esc($c['telephone']) ?>
                      </span>
                    </td>
                    <td class="text-end font-monospace fw-bold text-success">
                      <?= number_format($c['solde'], 2, ',', ' ') ?> <small class="text-muted">Ar</small>
                    </td>
                    <td class="text-center">
                      <!-- Lien vers la situation détaillée -->
                      <a href="<?= base_url('operateur/client/situation/' . $c['id']) ?>" class="btn btn-primary btn-sm px-3 py-1.5 fw-semibold">
                        <i class="bi bi-eye-fill me-1"></i> Voir la situation
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="4" class="text-center py-4 text-muted">
                    <i class="bi bi-person-x fs-3 d-block mb-2"></i>
                    Aucun client enregistré dans le système.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

</body>
</html>