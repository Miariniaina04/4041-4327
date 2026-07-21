<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Opérateur</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<body style="background-color: var(--bs-body-bg); min-height: 100vh;" class="py-4">

<main class="container" style="max-width: 900px;">
    
    <!-- En-tête de la page -->
    <div class="mb-4">
      <h1 class="h3 fw-bold text-dark mb-1">
        <i class="bi bi-pie-chart-fill text-warning me-2"></i>Tableau de bord des Commissions
      </h1>
      <p class="text-muted small mb-0">Vue synthétique des bénéfices et frais générés par type d'opération.</p>
    </div>

    <!-- Carte Néomorphique Principale -->
    <div class="card border-0 p-3" style="box-shadow: var(--bs-box-shadow);">
      <div class="card-body p-0">
        
        <div class="p-3 mb-2 border-bottom border-light-subtle d-flex align-items-center">
          <h5 class="h6 fw-bold text-primary mb-0">
            <i class="bi bi-list-stars me-2"></i>Récapitulatif des flux par référence
          </h5>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
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
                    <td class="ps-4 font-monospace text-secondary small">#00<?= esc($op['reference_id']) ?></td>
                    <td>
                      <?php
                        // Association des styles de badges selon l'opération
                        $badgeStyle = 'bg-primary-subtle text-primary border border-primary-subtle';
                        if ($op['reference_id'] == 1) {
                            $badgeStyle = 'bg-success-subtle text-success border border-success-subtle';
                        } elseif ($op['reference_id'] == 2) {
                            $badgeStyle = 'bg-warning-subtle text-warning border border-warning-subtle';
                        } elseif ($op['reference_id'] == 3) {
                            $badgeStyle = 'bg-info-subtle text-info border border-info-subtle';
                        }
                      ?>
                      <span class="badge <?= $badgeStyle ?> px-3 py-1.5 rounded">
                        <?= esc($op['type_nom']) ?>
                      </span>
                    </td>
                    <td class="text-end pe-4 fw-bold text-dark font-monospace">
                      <?= number_format($op['total_gains'], 2, ',', ' ') ?> <small class="text-muted">Ar</small>
                    </td>
                  </tr>
                <?php endforeach; ?>
                
                <!-- Ligne du Total Général (Style Relief Enfoncé) -->
                <tr>
                  <td colspan="2" class="ps-4 text-uppercase text-end fw-bold text-secondary align-middle">
                    Bénéfice Net Total :
                  </td>
                  <td class="text-end pe-4">
                    <div class="p-2 rounded-3 d-inline-block px-3" style="background-color: var(--bs-body-bg); box-shadow: var(--bs-box-shadow-inset);">
                      <span class="fw-bold text-primary fs-5 font-monospace">
                        <?= number_format($grandTotal, 2, ',', ' ') ?> <small class="fs-6">Ar</small>
                      </span>
                    </div>
                  </td>
                </tr>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center py-4 text-muted">
                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                    Aucune transaction enregistrée pour le moment.
                  </td>
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