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
    <form action="<?php echo base_url('transaction/effectuer'); ?>" method="post">
        
        <!-- ID du compte connecté (Simulé ici à 1, à remplacer dynamiquement en production) -->
        <input type="hidden" name="compte_id" id="compte_id" value="1">

        <p>
            <label for="type_id">Type d'opération :</label>
            <select id="type_id" name="type_id" required>
                <option value="">-- Choisir --</option>
                <option value="1">Dépôt</option>
                <option value="2">Retrait</option>
                <option value="3">Transfert</option>
            </select>
        </p>

        <!-- Ce champ ne s'affiche QUE si on choisit "Transfert" -->
        <p id="bloc-destination" class="hidden">
            <label for="compte_destination">ID du compte destinataire :</label>
            <input type="number" id="compte_destination" name="compte_destination">
        </p>

        <p>
            <label for="montant">Montant (Ar) :</label>
            <input type="number" id="montant" name="montant" min="1" required>
        </p>

        <div class="frais-box">
            <p>Frais estimés : <strong><span id="affichage-frais">0</span> Ar</strong></p>
            <p>Montant Total Impacté : <strong><span id="affichage-total">0</span> Ar</strong></p>
            <div id="message-erreur" class="error-message"></div>
        </div>

        <p>
            <button type="submit" id="btn-valider">Valider l'opération</button>
        </p>
    </form>
</div>

<script>
    const inputType = document.getElementById('type_id');
    const inputMontant = document.getElementById('montant');
    const inputCompteId = document.getElementById('compte_id');
    const blocDestination = document.getElementById('bloc-destination');
    const inputDestination = document.getElementById('compte_destination');
    
    const affichageFrais = document.getElementById('affichage-frais');
    const affichageTotal = document.getElementById('affichage-total');
    const messageErreur = document.getElementById('message-erreur');
    const btnValider = document.getElementById('btn-valider');

    // Afficher ou masquer le champ destination selon le type d'opération
    inputType.addEventListener('change', function() {
        if (this.value == "3") {
            blocDestination.classList.remove('hidden');
            inputDestination.required = true;
        } else {
            blocDestination.classList.add('hidden');
            inputDestination.required = false;
            inputDestination.value = "";
        }
        calculerFrais();
    });

    function calculerFrais() {
        const typeId = inputType.value;
        const montant = inputMontant.value;
        const compteId = inputCompteId.value;

        if (!typeId || !montant || montant <= 0) {
            affichageFrais.innerText = "0";
            affichageTotal.innerText = "0";
            messageErreur.innerText = "";
            btnValider.disabled = false;
            return;
        }

        // Appel vers la méthode AJAX de OperationController (attention à l'URL de ta route)
        fetch(`<?php echo base_url('operation/calcul-frais-ajax'); ?>?type_id=${typeId}&montant=${montant}&compte_id=${compteId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    affichageFrais.innerText = data.frais;
                    affichageTotal.innerText = data.total;
                    messageErreur.innerText = "";
                    btnValider.disabled = false;
                } else {
                    affichageFrais.innerText = "-";
                    affichageTotal.innerText = "-";
                    messageErreur.innerText = data.message;
                    btnValider.disabled = true; 
                }
            })
            .catch(error => console.error('Erreur:', error));
    }

    inputMontant.addEventListener('input', calculerFrais);
</script>

</body>
</html>