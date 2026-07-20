<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard client</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet" />
</head>
<body>
    <main style="padding: 2rem; max-width: 900px; margin: 0 auto;">
        <h1>Tableau de bord client</h1>
        <p>Bienvenue, <?= esc(session()->get('user_phone')) ?: 'utilisateur' ?>.</p>
        <p>Solde : </p>
        
        <p>Vous êtes connecté et votre compte est prêt.</p>
        <p><a href="<?= base_url('/client/operation') ?>">Effectuer un operation</a></p>

    </main>
</body>
</html>
