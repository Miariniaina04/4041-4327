<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Historique de Compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>"></div>
</head>
<body style="background-color: var(--bs-body-bg); min-height: 100vh;">
    <!-- Barre de navigation néomorphique douce -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4" style="box-shadow: var(--bs-box-shadow);">
        <div class="container">
            <span class="navbar-brand fw-bold text-primary">
                <i class="bi bi-speedometer2 me-2"></i>E-Espace
            </span>
            <div class="ms-auto">
                <span class="navbar-text fw-medium me-3">
                    <i class="bi bi-person-circle me-1"></i> <?= esc(session()->get('user_phone')) ?: 'Utilisateur' ?>
                </span>
                <!-- Bouton de déconnexion si besoin, sinon vous pouvez le retirer -->
                <a href="<?= base_url('/logout') ?>" class="btn btn-sm btn-light border-0" style="box-shadow: var(--bs-box-shadow-inset);">
                    Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container" style="max-width: 900px;">

        <!-- En-tête de page -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div class="mt-3 mt-md-0">
                <a href="<?= base_url('/client/dashboard') ?>" class="btn btn-primary fw-semibold px-3 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Retour au dashboard
                </a>
            </div>
        </div>

        <!-- Messages Flash Notifications -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 mb-4" role="alert" style="box-shadow: var(--bs-box-shadow);">
                <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" role="alert" style="box-shadow: var(--bs-box-shadow);">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Affichage du Solde Actuel -->
        <div class="card border-0 p-4 mb-5" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-7 mb-3 mb-md-0">
                        <span class="text-uppercase text-muted fw-bold small mb-2 d-block">Solde Disponible</span>
                        <h2 class="display-6 fw-bold text-primary mb-0">
                            <?= number_format($compte['solde'], 2, ',', ' ') ?> Ar
                        </h2>
                    </div>
                    <div class="col-md-5 text-md-end border-start-md ps-md-4">
                        <span class="text-muted small d-block mb-1">Numéro de compte</span>
                        <span class="badge bg-light text-dark font-monospace fs-6 px-3 py-2" style="box-shadow: var(--bs-box-shadow-inset);">
                            <i class="bi bi-telephone-fill me-1 text-primary"></i> <?= esc($compte['telephone']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau Historique -->
        <div class="card border-0 p-4" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <h2 class="h4 fw-bold text-primary mb-4">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Historique des opérations
                </h2>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Montant</th>
                                <th>Frais</th>
                                <th class="text-end">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($transactions)): ?>
                                <?php foreach ($transactions as $t): ?>
                                    <tr>
                                        <td class="text-body small">
                                            <i class="bi bi-calendar3 me-1"></i><?= date('d/m/Y H:i', strtotime($t['date_transaction'])) ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-body px-2.5 py-1">
                                                Type <?= number_format($t['operation_type_id']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong class="text-dark"><?= number_format($t['montant'], 2, ',', ' ') ?> Ar</strong>
                                        </td>
                                        <td class="text-muted small">
                                            <?= number_format($t['frais'], 2, ',', ' ') ?> Ar
                                        </td>
                                        <td class="text-end">
                                            <?php 
                                                $statut = strtolower($t['statut']);
                                                $badgeClass = 'bg-secondary';
                                                if(in_array($statut, ['valide', 'validé', 'effectué', 'succès'])) $badgeClass = 'bg-success-subtle text-success border border-success-subtle';
                                                else if(in_array($statut, ['en attente', 'pending'])) $badgeClass = 'bg-warning-subtle text-warning border border-warning-subtle';
                                                else if(in_array($statut, ['échoué', 'annulé', 'erreur'])) $badgeClass = 'bg-danger-subtle text-danger border border-danger-subtle';
                                            ?>
                                            <span class="badge <?= $badgeClass ?> px-2.5 py-1 rounded">
                                                <?= ucfirst($t['statut']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Aucune transaction enregistrée.
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