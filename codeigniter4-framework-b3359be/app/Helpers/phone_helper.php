<?php

if (!function_exists('detecter_operateur')) {
    /**
     * Détecte l'opérateur mobile à partir d'un numéro de téléphone malgache
     * @param string $telephone
     * @return string|null (Nom de l'opérateur ou null si invalide)
     */
    function detecter_operateur($telephone) 
    {
        // 1. Nettoyer le numéro (enlever les espaces, points, etc.)
        $telephone = preg_replace('/\s+/', '', $telephone);

        // 2. Extraire le préfixe à 3 chiffres (ex: 034, 032, 033)
        // Cette regex gère aussi si le numéro commence par +261 ou 261
        if (preg_match('/^(?:\+261|261)?(03[23478])\d{7}$/', $telephone, $matches)) {
            $prefixe = $matches[1];

            // Si le numéro a été saisi avec +26134..., on s'assure d'avoir le format "034"
            if (strpos($prefixe, '0') !== 0) {
                $prefixe = '0' . substr($prefixe, -2);
            }

            // 3. Correspondance des préfixes
            switch ($prefixe) {
                case '034':
                case '038':
                    return 'Telma';
                case '032':
                case '037':
                    return 'Orange';
                case '033':
                    return 'Airtel';
            }
        }

        return null; // Numéro invalide ou opérateur inconnu
    }
}