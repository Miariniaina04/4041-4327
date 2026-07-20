<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Préfixe</title>
</head>
<body>

    <p><a href="<?php echo base_url('operateur'); ?>"><- Annuler et retourner</a></p>

    <h1>Ajouter un nouveau préfixe valide</h1>

    <form action="<?php echo base_url('operateur/storePrefixe'); ?>" method="post">
        
        <p>
            <label for="prefix">Préfixe (ex: 033, 037) :</label><br>
            <input type="text" id="prefix" name="prefix" maxlength="4" required>
        </p>

        <p>
            <label for="description">Description :</label><br>
            <textarea id="description" name="description" rows="4" cols="30"></textarea>
        </p>

        <p>
            <button type="submit">Enregistrer le préfixe</button>
        </p>

    </form>

</body>
</html>