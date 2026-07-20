<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Tableau de bord des Gains</title>
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/bootstrap.min.css') ?>"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>"/>
</head>
<body>

<main class="container mt-5">
  <div class="page-header mb-4">
    <h1 class="page-title"><i class="fa fa-chart-pie text-gold me-2"></i> Tableau de bord des Commissions</h1>
  </div>

  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0"><i class="fa fa-list me-2"></i>Récapitulatif des flux par référence</h5>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-striped mb-0 align-middle">
          <thead class="table-light">
            <tr>
              <th scope="col" class="ps-4">Référence (Type ID)</th>
              <th scope="col">Type d'opération</th>
              <th scope="col" class="text-end pe-4">Total des Gains Cumulés</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($fraisOperations)): ?>
              <?php 
              $grandTotal = 0;
              foreach ($fraisOperations as $op): 
                $grandTotal += $op['total_gains'];
              ?>
                <tr>
                  <td class="ps-4 font-monospace fw-bold text-secondary">#00<?= esc($op['reference_id']) ?></td>
                  <td>
                    <span class="badge bg-opacity-10 
                      <?= $op['reference_id'] == 1 ? 'bg-success text-success' : ($op['reference_id'] == 2 ? 'bg-danger text-danger' : 'bg-primary text-primary') ?> p-2">
                      <?= esc($op['type_nom']) ?>
                    </span>
                  </td>
                  <td class="text-end pe-4 fw-bold text-dark">
                    <?= number_format($op['total_gains'], 2, ',', ' ') ?> <small>Ar</small>
                  </td>
                </tr>
              <?php endforeach; ?>
              
              <!-- Ligne du Total Général -->
              <tr class="table-dark fw-bold">
                <td colspan="2" class="ps-4 text-uppercase text-end">Bénéfice Net Total :</td>
                <td class="text-end pe-4 text-warning fs-5">
                  <?= number_format($grandTotal, 2, ',', ' ') ?> <small>Ar</small>
                </td>
              </tr>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center py-4 text-muted">Aucune transaction enregistrée pour le moment.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script src="<?= base_url('assets/bootstrap/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>