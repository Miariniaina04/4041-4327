<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">

</head>
<body>

    <div class="container" style="max-width: 650px;">
        
        <!-- Lien de retour rapide -->
        <div class="mb-4">
            <a href="<?php echo base_url('operateur'); ?>" class="btn btn-sm btn-light border-0" style="box-shadow: var(--bs-box-shadow);">
                <i class="bi bi-arrow-left me-1"></i> Annuler et retourner
            </a>
        </div>

        <!-- Carte Néomorphique -->
        <div class="card border-0 p-4" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <h1 class="h3 fw-bold text-primary mb-4">
                    <i class="bi bi-pencil-square me-2"></i>Modifier le Barème #<?php echo $bareme['id']; ?>
                </h1>

                <form action="<?php echo base_url('operateur/updateBareme/' . $bareme['id']); ?>" method="post">
                    
                    <!-- Sélection du Type d'Opération -->
                    <div class="mb-4">
                        <label for="operation_type_id" class="form-label fw-semibold">Type d'opération</label>
                        <select id="operation_type_id" name="operation_type_id" class="form-select" required>
                            <option value="1" <?php echo ($bareme['operation_type_id'] == 1) ? 'selected' : ''; ?>>1 - Dépôt</option>
                            <option value="2" <?php echo ($bareme['operation_type_id'] == 2) ? 'selected' : ''; ?>>2 - Retrait</option>
                            <option value="3" <?php echo ($bareme['operation_type_id'] == 3) ? 'selected' : ''; ?>>3 - Transfert</option>
                        </select>
                    </div>

                    <!-- Ligne Montant Min & Max -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="min_montant" class="form-label fw-semibold">Montant Minimum (Ar)</label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.01" 
                                       id="min_montant" 
                                       name="min_montant" 
                                       class="form-control" 
                                       value="<?php echo $bareme['min_montant']; ?>" 
                                       required>
                                <span class="input-group-text text-muted border-0">Ar</span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="max_montant" class="form-label fw-semibold">Montant Maximum (Ar)</label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.01" 
                                       id="max_montant" 
                                       name="max_montant" 
                                       class="form-control" 
                                       value="<?php echo $bareme['max_montant']; ?>" 
                                       required>
                                <span class="input-group-text text-muted border-0">Ar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Champ Frais -->
                    <div class="mb-4">
                        <label for="frais" class="form-label fw-semibold">Frais appliqués (Ar)</label>
                        <div class="input-group">
                            <input type="number" 
                                   step="0.01" 
                                   id="frais" 
                                   name="frais" 
                                   class="form-control fw-bold text-primary" 
                                   value="<?php echo $bareme['frais']; ?>" 
                                   required>
                            <span class="input-group-text text-muted border-0">Ar</span>
                        </div>
                    </div>

                    <!-- Bouton de mise à jour -->
                    <div class="d-grid pt-2">
                        <button type="submit" class="btn btn-primary py-2.5 fw-bold">
                            <i class="bi bi-save me-1"></i> Mettre à jour le barème
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

  <footer class="footer-public">
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('js/bootstrap.js') ?>"></script>
</body>
</html>