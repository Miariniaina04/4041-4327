<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Effectuer une opération</title>
</head>
<body>

<div class="container">
    <h1>Faire une opération Mobile Money</h1>
    <p><a href="<?php echo base_url('transaction'); ?>"><- Voir mon historique</a></p>

    <!-- L'action pointe bien vers la méthode save via la route dédiée -->
    <form action="<?= base_url('transaction/effectuer'); ?>" method="post">
    <h2>📥 Effectuer un Dépôt</h2>
    <input type="hidden" name="type_id" id="type_id" value="1">
    
    <p>
        <label for="montant">Montant à déposer (Ar) :</label>
        <input type="number" id="montant" name="montant" required min="1">
    </p>
    
    <div style="background: #e8f4fd; padding: 10px; margin-bottom: 10px;">
        <p>Frais retenus : <span id="affichage-frais">0</span> Ar</p>
        <p>Total crédité : <span id="affichage-total">0</span> Ar</p>
        <div id="message-erreur" style="color:red;"></div>
    </div>
    <button type="submit" id="btn-valider">Valider le dépôt</button>
</form>
<script src="<?= base_url('js/calculFrais.js') ?>"></script>
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
            fetch(`<?php echo base_url('operation/calcul-frais-ajax'); ?>?type_id=${typeId}&montant=${montant}`)
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