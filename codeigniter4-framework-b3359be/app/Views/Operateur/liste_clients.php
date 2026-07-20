<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Gestion des Clients — Opérateur</title>
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/bootstrap.min.css') ?>"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-secondary"><i class="fa fa-users text-primary me-2"></i> Liste des Comptes Clients</h1>
    <a href="<?= base_url('operateur/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
      <i class="fa fa-home"></i> Tableau de bord
    </a>
  </div>

  <!-- Tableau des clients -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-dark">
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
                  <td class="ps-4 font-monospace fw-bold text-muted">#00<?= esc($c['id']) ?></td>
                  <td>
                    <span class="fw-bold text-dark"><?= esc($c['telephone']) ?></span>
                  </td>
                  <td class="text-end font-monospace fw-bold text-success">
                    <?= number_format($c['solde'], 2, ',', ' ') ?> <small>Ar</small>
                  </td>
                  <td class="text-center">
                    <!-- Le lien vers la situation détaillée du client -->
                    <a href="<?= base_url('operateur/situation/' . $c['id']) ?>" class="btn btn-primary btn-sm px-3">
                      <i class="fa fa-eye me-1"></i> Voir la situation
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center py-4 text-muted">Aucun client enregistré dans le système.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>