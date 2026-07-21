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
            <a href="<?php echo base_url(''); ?>" class="btn btn-sm btn-primary border-0" style="box-shadow: var(--bs-box-shadow);">
                <i class="bi bi-arrow-left me-1"></i> Retour au dashboard
            </a>
        </div>

        <!-- Carte Principale -->
        <div class="card border-0 p-4" style="box-shadow: var(--bs-box-shadow);">
            <div class="card-body">
                
                <h1 class="h3 fw-bold text-dark mb-1">Mobile Money</h1>
                <p class="text-muted small mb-4">Effectuez vos transactions en toute sécurité.</p>

                <!-- Formulaire de transfert -->
                <form action="<?= base_url('/client/transaction/effectuer'); ?>" method="post">
                    
                    <h2 class="h5 fw-bold text-primary mb-4">
                        <i class="bi bi-arrow-left-right me-2"></i>Effectuer un Transfert
                    </h2>
                    
                    <!-- Type d'opération masqué (3 = Transfert) -->
                    <input type="hidden" name="type_id" id="type_id" value="3">
                    
                    <!-- Champ Téléphone Destinataire -->
                    <div class="mb-3">
                        <label for="telephone_destination" class="form-label fw-semibold">Numéro de téléphone du destinataire</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-0"><i class="bi bi-telephone-fill"></i></span>
                            <input type="text" 
                                   id="telephone_destination" 
                                   name="telephone_destination" 
                                   class="form-control" 
                                   placeholder="Ex: 034XXXXXXX" 
                                   required>
                        </div>
                    </div>

                    <!-- Champ Montant -->
                    <div class="mb-4">
                        <label for="montant" class="form-label fw-semibold">Montant à envoyer (Ar)</label>
                        <div class="input-group">
                            <input type="number" 
                                   id="montant" 
                                   name="montant" 
                                   class="form-control" 
                                   placeholder="Ex: 25000" 
                                   required 
                                   min="1">
                            <span class="input-group-text bg-light text-muted border-0">Ar</span>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>