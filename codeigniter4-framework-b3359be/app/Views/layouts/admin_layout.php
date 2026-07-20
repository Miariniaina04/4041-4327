<!DOCTYPE html>
<html lang="fr">
<head>
    <?= view('partials/head') ?>
</head>
<body>

<div class="app-wrapper">

    <?= view('partials/sidebar_admin') ?>

    <div class="main-content">

        <?= view('partials/topbar') ?>

        <div class="page-content">
            <?= $this->renderSection('content') ?>
        </div>

    </div>

</div>

<script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>