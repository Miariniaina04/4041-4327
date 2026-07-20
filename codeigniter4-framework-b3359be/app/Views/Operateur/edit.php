<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Barème</title>
</head>
<body>

    <p><a href="<?php echo base_url('operateur'); ?>"><- Annuler et retourner</a></p>

    <h1>Modifier le Barème de Frais #<?php echo $bareme['id']; ?></h1>

    <form action="<?php echo base_url('operateur/updateBareme/' . $bareme['id']); ?>" method="post">
        
        <!-- ID du type d'opération (depot=1, retrait=2, transfert=3 d'après votre base.sql) -->
        <p>
            <label for="operation_type_id">Type d'opération (ID) :</label><br>
            <input type="number" id="operation_type_id" name="operation_type_id" value="<?php echo $bareme['operation_type_id']; ?>" required>
        </p>

        <p>
            <label for="min_montant">Montant Minimum (Ar) :</label><br>
            <input type="number" step="0.01" id="min_montant" name="min_montant" value="<?php echo $bareme['min_montant']; ?>" required>
        </p>

        <p>
            <label for="max_montant">Montant Maximum (Ar) :</label><br>
            <input type="number" step="0.01" id="max_montant" name="max_montant" value="<?php echo $bareme['max_montant']; ?>" required>
        </p>

        <p>
            <label for="frais">Frais (Ar) :</label><br>
            <input type="number" step="0.01" id="frais" name="frais" value="<?php echo $bareme['frais']; ?>" required>
        </p>

        <p>
            <button type="submit">Mettre à jour le barème</button>
        </p>

    </form>

</body>
</html>