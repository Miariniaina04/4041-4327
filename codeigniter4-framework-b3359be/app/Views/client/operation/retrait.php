<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Effectuer une opération</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">
</head>
<body style="background-color: var(--bs-body-bg); min-height: 100vh;" class="py-4">

<div class="container" style="max-width: 600px;">
        
        <!-- Lien de retour vers dashboard -->
        <div class="mb-4">
            <a href="<?php echo base_url('/client/dashboard'); ?>" class="btn btn-sm btn-primary border-0" style="box-shadow: var(--bs-box-shadow);">
                <i class="bi bi-arrow-left me-1"></i> Retour au dashboard
            </a>
        </div>

        <!-- Carte Principale -->
        <div class="card border-0 p-4" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <h1 class="h3 fw-bold text-dark mb-1">Mobile Money</h1>
                <p class="text-muted small mb-4">Effectuez vos transactions en toute sécurité.</p>

                <!-- Formulaire de retrait -->
                <form action="<?= base_url('/client/transaction/effectuer'); ?>" method="post">
                    
                    <h2 class="h5 fw-bold text-primary mb-3">
                        <i class="bi bi-arrow-up-circle-fill me-2"></i>Effectuer un Retrait
                    </h2>
                    
                    <!-- Type d'opération masqué (2 = Retrait) -->
                    <input type="hidden" name="type_id" id="type_id" value="2">
                    
                    <!-- Champ Montant -->
                    <div class="mb-4">
                        <label for="montant" class="form-label fw-semibold">Montant à retirer (Ar)</label>
                        <div class="input-group">
                            <input type="number" 
                                   id="montant" 
                                   name="montant" 
                                   class="form-control" 
                                   placeholder="Ex: 10000" 
                                   required 
                                   min="1">
                            <span class="input-group-text bg-light text-muted border-0">Ar</span>
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- Panneau de Récapitulatif Dynamique (Style creusé/Soft UI) -->
                        <div class="col-md-6">
                            <div class="p-4 rounded-3 mb-4" style="background-color: var(--bs-body-bg); box-shadow: var(--bs-box-shadow-inset);">
                                <div class="d-flex justify-content-between pt-2 border-top border-light-subtle">
                                    <span class="text-secondary small">Frais retenus :</span>
                                    <span class="fw-bold text-dark"><span id="affichage-frais">0</span> Ar</span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="p-4 rounded-3 mb-4" style="background-color: var(--bs-body-bg); box-shadow: var(--bs-box-shadow-inset);">
                                <div class="d-flex justify-content-between pt-2 border-top border-light-subtle">
                                    <span class="text-secondary small fw-medium">Total débité :</span>
                                    <span class="fw-bold text-danger"><span id="affichage-total">0</span> Ar</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conteneur pour vos messages d'erreur JS -->
                    <div id="message-erreur" class="text-danger small mt-2 fw-medium" style="display: none;"></div>

                    <!-- Bouton de Validation -->
                    <div class="d-grid">
                        <button type="submit" id="btn-valider" class="btn btn-primary py-2.5 fw-bold">
                            Valider le retrait
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Éléments toujours présents dans les 3 formulaires
    const inputMontant = document.getElementById('montant');
    const inputType = document.getElementById('type_id'); // Récupère la valeur fixe (1, 2 ou 3)
    const affichageFrais = document.getElementById('affichage-frais');
    const affichageTotal = document.getElementById('affichage-total');
    const messageErreur = document.getElementById('message-erreur');
    const btnValider = document.getElementById('btn-valider');

    // Sécurité : on vérifie que les éléments essentiels existent sur la page
    if (inputMontant && inputType) {
        
        // On lance le calcul dès que l'utilisateur écrit un montant
        inputMontant.addEventListener('input', function () {
            const montant = this.value;
            const typeId = inputType.value;

            if (!montant || montant <= 0) {
                affichageFrais.innerText = "0";
                affichageTotal.innerText = "0";
                messageErreur.innerText = "";
                btnValider.disabled = false;
                return;
            }

            // Appel AJAX vers ton contrôleur (sans le compte_id puisqu'il est en session !)
            fetch(`<?php echo base_url('/client/operation/calcul-frais-ajax'); ?>?type_id=${typeId}&montant=${montant}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        affichageFrais.innerText = data.frais;
                        affichageTotal.innerText = data.total;
                        messageErreur.innerText = "";
                        btnValider.disabled = false; // Réactive le bouton
                    } else {
                        affichageFrais.innerText = "-";
                        affichageTotal.innerText = "-";
                        messageErreur.innerText = data.message;
                        btnValider.disabled = true; // Bloque la soumission si le montant est hors barème
                    }
                })
                .catch(error => console.error('Erreur de calcul des frais:', error));
        });
    }
});
</script>

</body>
</html>