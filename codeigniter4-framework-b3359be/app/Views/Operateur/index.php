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
        
        <!-- En-tête de la page -->
        <div class="row mb-5 text-center text-md-start align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold text-dark mb-1">Configuration Opérateur</h1>
                <p class="text-muted mb-0">Gestion globale des préfixes téléphoniques et des barèmes de frais de transaction.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span class="badge bg-primary px-3 py-2 rounded-pill fs-6" style="box-shadow: var(--bs-box-shadow);">
                    <i class="bi bi-gear-fill me-1"></i> Mode Admin
                </span>
            </div>
        </div>

        <!-- SECTION 1 : PRÉFIXES -->
        <div class="card border-0 p-4 mb-5" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4">
                    <h2 class="h4 fw-bold text-primary mb-3 mb-sm-0">
                        <i class="bi bi-phone me-2"></i>Gestion des Préfixes Valides
                    </h2>
                    <a href="<?php echo base_url('operateur/createPrefixe'); ?>" class="btn btn-sm btn-primary px-3">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter un préfixe
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Préfixe</th>
                                <th>Description</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($prefixes)): ?>
                                <?php foreach ($prefixes as $prefixe): ?>
                                    <tr>
                                        <td class="text-secondary small">#<?php echo $prefixe['id']; ?></td>
                                        <td><span class="badge bg-light text-dark font-monospace fs-6 px-3 py-2" style="box-shadow: var(--bs-box-shadow-inset);"><?php echo $prefixe['prefix']; ?></span></td>
                                        <td><?php echo $prefixe['description']; ?></td>
                                        <td>
                                            <?php if ($prefixe['actif'] == 1): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded">Actif</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 rounded">Inactif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <?php if ($prefixe['actif'] == 1): ?>
                                                <a href="<?php echo base_url('operateur/desactiverPrefixe/' . $prefixe['id']); ?>" 
                                                   onclick="return confirm('Désactiver ce préfixe ?');" 
                                                   class="btn btn-sm btn-outline-danger border-0"
                                                   title="Désactiver">
                                                    <i class="bi bi-toggle-on fs-5"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Aucun préfixe configuré.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <!-- SECTION 2 : BARÈMES -->
        <div class="card border-0 p-4" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <div class="mb-4">
                    <h2 class="h4 fw-bold text-primary">
                        <i class="bi bi-calculator me-2"></i>Barèmes de Frais par Tranche
                    </h2>
                    <p class="text-muted small">Définition des commissions appliquées selon le montant de l'opération.</p>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Type d'opération (ID)</th>
                                <th>Montant Min</th>
                                <th>Montant Max</th>
                                <th>Frais</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($baremes)): ?>
                                <?php foreach ($baremes as $bareme): ?>
                                    <tr>
                                        <td class="text-secondary small">#<?php echo $bareme['id']; ?></td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary px-2 py-1">
                                                Type <?php echo $bareme['operation_type_id']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo number_format($bareme['min_montant'], 2, ',', ' '); ?> <span class="small text-muted">Ar</span></td>
                                        <td><?php echo number_format($bareme['max_montant'], 2, ',', ' '); ?> <span class="small text-muted">Ar</span></td>
                                        <td><strong class="text-primary"><?php echo number_format($bareme['frais'], 2, ',', ' '); ?> Ar</strong></td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo base_url('operateur/editBareme/' . $bareme['id']); ?>" 
                                                   class="btn btn-sm btn-light border-0 me-1" 
                                                   style="box-shadow: var(--bs-box-shadow-inset);"
                                                   title="Modifier">
                                                    <i class="bi bi-pencil-square text-dark"></i>
                                                </a>
                                                <a href="<?php echo base_url('operateur/deleteBareme/' . $bareme['id']); ?>" 
                                                   onclick="return confirm('Supprimer ce barème ?');" 
                                                   class="btn btn-sm btn-light border-0" 
                                                   style="box-shadow: var(--bs-box-shadow-inset);"
                                                   title="Supprimer">
                                                    <i class="bi bi-trash3-fill text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Aucun barème configuré.</td>
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