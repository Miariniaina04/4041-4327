<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <title>Commissions</title>
</head>
<body>
<div class="card border-0 p-4 mt-5" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <div class="mb-4">
                    <h2 class="h4 fw-bold text-primary">
                        <i class="bi bi-coin me-2"></i>Commissions de Transfert
                    </h2>
                    <p class="text-muted small">Frais appliqués aux transferts inter-opérateurs (+5% de commission).</p>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tranche</th>
                                <th>Montant Min</th>
                                <th>Montant Max</th>
                                <th>Frais de Base</th>
                                <th>Commission (+5%)</th>
                                <th class="fw-bold text-success">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($commissions)): ?>
                                <?php foreach ($commissions as $index => $comm): ?>
                                    <tr>
                                        <td class="text-secondary small">Tranche <?php echo $index + 1; ?></td>
                                        <td><?php echo number_format($comm['min_montant'], 2, ',', ' '); ?> <span class="small text-muted">Ar</span></td>
                                        <td><?php echo number_format($comm['max_montant'], 2, ',', ' '); ?> <span class="small text-muted">Ar</span></td>
                                        <td><?php echo number_format($comm['frais'], 2, ',', ' '); ?> <span class="small text-muted">Ar</span></td>
                                        <td class="text-warning-emphasis">
                                            +<?php echo number_format(($comm[''] * 0.05), 2, ',', ' '); ?> <span class="small text-muted">Ar</span>
                                        </td>
                                        <td class="fw-bold text-success">
                                            <?php echo number_format($comm['commission'], 2, ',', ' '); ?> <span class="small">Ar</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Aucune commission de transfert configurée.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</body>
</html>