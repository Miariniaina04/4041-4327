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

<div class="container" style="max-width: 1000px;">
    
    <!-- Bouton Retour -->
    <div class="mb-4">
      <a href="javascript:history.back()" class="btn btn-sm btn-light border-0 px-3 py-2" style="box-shadow: var(--bs-box-shadow);">
        <i class="bi bi-arrow-left me-1"></i> Retour
      </a>
    </div>

    <!-- Affichage du Solde Actuel -->
  <div class="card border-0 p-4 mb-5" style="box-shadow: var(--bs-box-shadow);">
      <div class="card-body">
          <div class="row align-items-center">
              <div class="col-md-7 mb-3 mb-md-0">
                  <span class="text-uppercase text-muted fw-bold small mb-2 d-block">Solde Disponible</span>
                  <h2 class="display-6 fw-bold text-success mb-0">
                      <?= number_format($client['solde'], 2, ',', ' ') ?> Ar
                  </h2>
              </div>
              <div class="col-md-5 text-md-end border-start-md ps-md-4">
                  <span class="text-muted small d-block mb-1">Numéro de compte</span>
                  <span class="badge bg-light text-dark font-monospace fs-6 px-3 py-2" style="box-shadow: var(--bs-box-shadow-inset);">
                      <i class="bi bi-telephone-fill me-1 text-primary"></i> <?= esc($client['telephone']) ?>
                  </span>
              </div>
          </div>
      </div>
  </div>
    <!-- Tableau des mouvements -->
    <div class="card border-0 p-3" style="box-shadow: var(--bs-box-shadow);">
      <div class="card-body p-0">
        
        <div class="p-3 mb-2 border-bottom border-light-subtle d-flex align-items-center">
          <h5 class="h6 fw-bold text-primary mb-0">
            <i class="bi bi-arrow-left-right me-2"></i>Historique des mouvements de fonds
          </h5>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="ps-4">ID Trans.</th>
                <th>Type</th>
                <th>Mouvement</th>
                <th class="text-end">Montant Net</th>
                <th class="text-end">Frais</th>
                <th class="text-end pe-4">Total Impacté</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $t): ?>
                  <?php 
                    // Logique pour définir si c'est une entrée ou une sortie d'argent pour CE client
                    $isIncoming = false;
                    
                    if ($t['operation_type_id'] == 1) {
                        // Un dépôt est toujours une entrée
                        $isIncoming = true;
                    } elseif ($t['operation_type_id'] == 3 && isset($t['compte_id_to']) && $t['compte_id_to'] == $client['id']) {
                        // Un transfert reçu est une entrée
                        $isIncoming = true;
                    }
                  ?>
                  <tr>
                    <td class="ps-4 text-secondary small font-monospace">#<?= esc($t['id']) ?></td>
                    <td>
                      <span class="badge bg-light text-dark font-monospace px-2.5 py-1.5" style="box-shadow: var(--bs-box-shadow-inset);">
                        <?= $t['operation_type_id'] == 1 ? '📥 Dépôt' : ($t['operation_type_id'] == 2 ? '📤 Retrait' : '🔄 Transfert') ?>
                      </span>
                    </td>
                    <td>
                      <?php if ($isIncoming): ?>
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded">
                          <i class="bi bi-graph-up-arrow me-1"></i> CRÉDIT (Entrée)
                        </span>
                      <?php else: ?>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded">
                          <i class="bi bi-graph-down-arrow me-1"></i> DÉBIT (Sortie)
                        </span>
                      <?php endif; ?>
                    </td>
                    <td class="text-end font-monospace fw-semibold text-dark">
                      <?= number_format($t['montant'], 2, ',', ' ') ?> <small class="text-muted">Ar</small>
                    </td>
                    <td class="text-end text-muted font-monospace small">
                      <?= number_format($t['frais'], 2, ',', ' ') ?> Ar
                    </td>
                    <td class="text-end pe-4 font-monospace fw-bold <?= $isIncoming ? 'text-success' : 'text-danger' ?>">
                      <?= $isIncoming ? '+' : '-' ?> <?= number_format($t['montant_total'], 2, ',', ' ') ?> <small>Ar</small>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center py-4 text-muted">
                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                    Aucune transaction trouvée pour ce compte client.
                  </td>
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