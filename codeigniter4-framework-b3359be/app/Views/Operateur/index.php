<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Configuration Opérateur</title>
</head>
<body>

    <h1>Tableau de Configuration Opérateur</h1>
    <h2>Gestion des Préfixes Valides</h2>
    <p><a href="<?php echo base_url('operateur/createPrefixe'); ?>">+ Ajouter un nouveau préfixe</a></p>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Préfixe</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($prefixes)): ?>
                <?php foreach ($prefixes as $prefixe): ?>
                    <tr>
                        <td><?php echo $prefixe['id']; ?></td>
                        <td><strong><?php echo $prefixe['prefix']; ?></strong></td>
                        <td><?php echo $prefixe['description']; ?></td>
                        <td><?php echo ($prefixe['actif'] == 1) ? 'Actif' : 'Inactif'; ?></td>
                        <td>
                            <a href="<?php echo base_url('operateur/show/' . $prefixe['id']); ?>">Voir détails</a> | 
                            <?php if ($prefixe['actif'] == 1): ?>
                                <a href="<?php echo base_url('operateur/desactiverPrefixe/' . $prefixe['id']); ?>" onclick="return confirm('Désactiver ce préfixe ?');">Désactiver</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun préfixe configuré.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <!-- SECTION BAREMES -->
    <h2>Barèmes de Frais par Tranche</h2>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type d'opération (ID)</th>
                <th>Montant Min (Ar)</th>
                <th>Montant Max (Ar)</th>
                <th>Frais (Ar)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($baremes)): ?>
                <?php foreach ($baremes as $bareme): ?>
                    <tr>
                        <td><?php echo $bareme['id']; ?></td>
                        <td><?php echo $bareme['operation_type_id']; ?></td>
                        <td><?php echo number_format($bareme['min_montant'], 2, ',', ' '); ?></td>
                        <td><?php echo number_format($bareme['max_montant'], 2, ',', ' '); ?></td>
                        <td><strong><?php echo number_format($bareme['frais'], 2, ',', ' '); ?></strong></td>
                        <td>
                            <a href="<?php echo base_url('operateur/editBareme/' . $bareme['id']); ?>">Modifier</a> | 
                            <a href="<?php echo base_url('operateur/deleteBareme/' . $bareme['id']); ?>" onclick="return confirm('Supprimer ce barème ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun barème configuré.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>