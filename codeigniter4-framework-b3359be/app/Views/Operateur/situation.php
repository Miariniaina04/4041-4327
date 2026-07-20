<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Situation Client - #<?= esc($client['id']) ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/bootstrap.min.css') ?>"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-light">

<div class="container mt-5">
  <!-- Bouton Retour -->
  <div class="mb-3">
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Retour</a>
  </div>

  <!-- Fiche de situation globale du Client -->
  <div class="card mb-4 border-0 shadow-sm">
    <div class="card-body bg-dark text-white rounded">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-muted text-uppercase mb-1" style="letter-spacing: 1px;">Situation du Client</h6>
          <h3 class="mb-0"><i class="fa fa-user text-warning me-2"></i> Téléphone : <?= esc($client['telephone']) ?></h3>
        </div>
        <div class="text-end">
          <span class="text-muted d-block font-size-sm">Solde Actuel</span>
          <h2 class="text-success fw-bold mb-0"><?= number_format($client['solde'], 2, ',', ' ') ?> <small>Ar</small></h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Tableau des mouvements -->
  <div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
      <h5 class="mb-0 text-secondary"><i class="fa fa-exchange-alt me-2"></i>Historique des mouvements de fonds</h5>
    </div>
    <div class="card-body p-0">
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
                  } elseif ($t['operation_type_id'] == 3 && $t['compte_id_to'] == $client['id']) {
                      // Un transfert reçu est une entrée
                      $isIncoming = true;
                  }
                ?>
                <tr>
                  <td class="ps-4 text-muted font-monospace">#<?= esc($t['id']) ?></td>
                  <td>
                    <span class="badge p-2 bg-light text-dark border">
                      <?= $t['operation_type_id'] == 1 ? '📥 Dépôt' : ($t['operation_type_id'] == 2 ? '📤 Retrait' : '🔄 Transfert') ?>
                    </span>
                  </td>
                  <td>
                    <?php if ($isIncoming): ?>
                      <span class="badge bg-success bg-opacity-10 text-success p-2"><i class="fa fa-arrow-trend-up"></i> CRÉDIT (Entrée)</span>
                    <?php else: ?>
                      <span class="badge bg-danger bg-opacity-10 text-danger p-2"><i class="fa fa-arrow-trend-down"></i> DÉBIT (Sortie)</span>
                    <?php endif; ?>
                  </td>
                  <td class="text-end font-monospace fw-bold">
                    <?= number_format($t['montant'], 2, ',', ' ') ?> Ar
                  </td>
                  <td class="text-end text-muted font-monospace">
                    <?= number_format($t['frais'], 2, ',', ' ') ?> Ar
                  </td>
                  <td class="text-end pe-4 font-monospace fw-bold <?= $isIncoming ? 'text-success' : 'text-danger' ?>">
                    <?= $isIncoming ? '+' : '-' ?> <?= number_format($t['montant_total'], 2, ',', ' ') ?> Ar
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">Aucune transaction trouvée pour ce compte client.</td>
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