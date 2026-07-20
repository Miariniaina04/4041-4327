<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard client</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">

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

    <!-- Contenu Principal -->
    <main class="container py-4" style="max-width: 900px;">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div class="mt-3 mt-md-0">
                <a href="<?= base_url('/client/transaction') ?>" class="btn btn-primary fw-semibold px-3 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Voir l'historique
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Carte du Solde (Effet sculpté) -->
            <div class="col">
                <div class="card h-100 border-0 p-3" style="box-shadow: var(--bs-box-shadow);">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-muted fw-bold small mb-3">Mon Solde Actuel</h6>
                            <!-- Remplacer par votre variable dynamique pour le solde -->
                            <h2 class="display-6 fw-bold text-primary mb-0">
                               <?= number_format($soldeActuel, 2, ',', ' ') ?> Ar <!--[cite: 15] -->
                            </h2>
                        </div>
                        <div class="mt-4 pt-2 border-top border-light-subtle">
                            <small class="text-success fw-medium">
                                <i class="bi bi-shield-check me-1"></i>Compte sécurisé actif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>

        <div class="row g-4">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" class="btn btn-primary" href="<?= base_url('/client/operation?type=depot') ?>">Dépôt</a>
                <a type="button" class="btn btn-primary" href="<?= base_url('/client/operation?type=retrait') ?>">Retrait</a>
                <a type="button" class="btn btn-primary" href="<?= base_url('/client/operation?type=transfert') ?>">Transfert</a>
            </div>
        </div>
    </main>

</body>
</html>