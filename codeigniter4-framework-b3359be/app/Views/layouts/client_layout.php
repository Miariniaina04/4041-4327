<!DOCTYPE html>
<html lang="fr">
<head>
    <?= view('partials/head') ?>
</head>
<body>

<div class="app-wrapper">

    <div class="main-content">

        <div class="page-content">
            <?= $this->renderSection('content') ?>
        </div>

    </div>

</div>

<script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>