<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Préfixe</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">

</head>
<body style="background-color: var(--bs-body-bg); min-height: 100vh;" class="py-4">

    <div class="container" style="max-width: 600px;">
        
        <!-- Lien de retour rapide -->
        <div class="mb-4">
            <a href="<?php echo base_url('operateur'); ?>" class="btn btn-sm btn-light border-0" style="box-shadow: var(--bs-box-shadow);">
                <i class="bi bi-arrow-left me-1"></i> Annuler et retourner
            </a>
        </div>

        <!-- Carte Néomorphique contenant le formulaire -->
        <div class="card border-0 p-4" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <h1 class="h3 fw-bold text-primary mb-4">
                    <i class="bi bi-plus-circle-fill me-2"></i>Nouveau préfixe valide
                </h1>

                <form action="<?php echo base_url('operateur/storePrefixe'); ?>" method="post">
                    
                    <!-- Champ Préfixe -->
                    <div class="mb-4">
                        <label for="prefix" class="form-label fw-semibold">Préfixe (ex: 033, 034, 032, 038)</label>
                        <input type="text" 
                               id="prefix" 
                               name="prefix" 
                               class="form-control" 
                               maxlength="4" 
                               placeholder="033" 
                               required>
                        <div class="form-text text-muted">Saisissez les 3 ou 4 premiers chiffres identifiant l'opérateur.</div>
                    </div>

                    <!-- Champ Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description / Notes</label>
                        <textarea id="description" 
                                  name="description" 
                                  class="form-control" 
                                  rows="4" 
                                  placeholder="Ex : Numéros mobiles Airtel Madagascar..."></textarea>
                    </div>

                    <!-- Bouton de validation -->
                    <div class="d-grid pt-2">
                        <button type="submit" class="btn btn-primary py-2.5 fw-bold">
                            <i class="bi bi-check-lg me-1"></i> Enregistrer le préfixe
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</body>
</html>