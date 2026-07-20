<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Historique de Compte</title>
</head>
<body>

<div class="container">
    <h1>Mon Espace Mobile Money</h1>
    
    <!-- Messages Flash notifications -->
    <?php if(session()->getFlashdata('success')): ?>
        <p class="alert-success"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <p class="alert-error"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <!-- Affichage du solde actuel -->
    <div class="solde-box">
        <h3>Téléphone : <?= esc($compte['telephone']) ?></h3>
        <h2>Mon Solde Actuel : <?= number_format($compte['solde'], 2, ',', ' ') ?> Ar</h2>
    </div>

    <p><a href="<?= base_url('operation') ?>">+ Faire une nouvelle opération</a></p>

    <!-- Tableau d'historique -->
    <h2>Historique des opérations</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Frais</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $t): ?>
                    <tr>
                        <td><?= $t['date_transaction'] ?></td>
                        <td><strong><?= strtoupper($t['type_nom']) ?></strong></td>
                        <td><?= number_format($t['montant'], 2, ',', ' ') ?> Ar</td>
                        <td><?= number_format($t['frais'], 2, ',', ' ') ?> Ar</td>
                        <td class="status"><?= ucfirst($t['statut']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucune transaction enregistrée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>