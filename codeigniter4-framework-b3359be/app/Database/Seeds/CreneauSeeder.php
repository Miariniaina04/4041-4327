<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreneauSeeder extends Seeder
{
    public function run()
    {
        //donnee test
        // Insertion des créneaux
        $creneauxData = [
            [
                'ressource_id' => 1, 
                'date_debut' => '2024-06-17 08:00:00',
                'date_fin' => '2024-06-17 09:00:00',
                'places_disponible' => 20
            ],
            [
                'ressource_id' => 1, 
                'date_debut' => '2024-06-17 18:00:00',
                'date_fin' => '2024-06-17 19:00:00',
                'places_disponible' => 20
            ],
            [
                'ressource_id' => 1, 
                'date_debut' => '2024-06-18 09:30:00',
                'date_fin' => '2024-06-18 10:30:00',
                'places_disponible' => 20
            ],
            [
                'ressource_id' => 2, 
                'date_debut' => '2024-06-17 07:00:00',
                'date_fin' => '2024-06-17 22:00:00',
                'places_disponible' => 30
            ],
            [
                'ressource_id' => 3, 
                'date_debut' => '2024-06-17 09:00:00',
                'date_fin' => '2024-06-17 10:00:00',
                'places_disponible' => 50
            ],
            [
                'ressource_id' => 3, 
                'date_debut' => '2024-06-17 10:00:00',
                'date_fin' => '2024-06-17 11:00:00',
                'places_disponible' => 50
            ],
            [
                'ressource_id' => 4, 
                'date_debut' => '2024-06-17 08:00:00',
                'date_fin' => '2024-06-17 09:00:00',
                'places_disponible' => 2
            ],
            [
                'ressource_id' => 5, 
                'date_debut' => '2024-06-17 19:00:00',
                'date_fin' => '2024-06-17 20:00:00',
                'places_disponible' => 25
            ],
        ];
        $this->db->table('creneaux')->insertBatch($creneauxData);

    }
}
