<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FraisBaremeSeeder extends Seeder
{
    public function run()
    {
        // Vider la table avant d'insérer (optionnel)
        $this->db->table('frais_baremes')->truncate();

        $data = [
            // Dépôt : généralement gratuit, mais on peut en mettre si besoin
            [
                'operation_type_id' => 1, // dépôt
                'min_montant' => 100,
                'max_montant' => 1000000,
                'frais' => 0
            ],

            // Retrait
            [
                'operation_type_id' => 2, // retrait
                'min_montant' => 100,
                'max_montant' => 1000,
                'frais' => 50
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 1001,
                'max_montant' => 5000,
                'frais' => 50
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 5001,
                'max_montant' => 10000,
                'frais' => 100
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 10001,
                'max_montant' => 25000,
                'frais' => 200
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 25001,
                'max_montant' => 50000,
                'frais' => 400
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 50001,
                'max_montant' => 100000,
                'frais' => 800
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 100001,
                'max_montant' => 250000,
                'frais' => 1500
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 250001,
                'max_montant' => 500000,
                'frais' => 1500
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 500001,
                'max_montant' => 1000000,
                'frais' => 2500
            ],
            [
                'operation_type_id' => 2,
                'min_montant' => 1000001,
                'max_montant' => 2000000,
                'frais' => 3000
            ],

            // Transfert (mêmes barèmes que retrait selon le sujet)
            [
                'operation_type_id' => 3, // transfert
                'min_montant' => 100,
                'max_montant' => 1000,
                'frais' => 50
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 1001,
                'max_montant' => 5000,
                'frais' => 50
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 5001,
                'max_montant' => 10000,
                'frais' => 100
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 10001,
                'max_montant' => 25000,
                'frais' => 200
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 25001,
                'max_montant' => 50000,
                'frais' => 400
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 50001,
                'max_montant' => 100000,
                'frais' => 800
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 100001,
                'max_montant' => 250000,
                'frais' => 1500
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 250001,
                'max_montant' => 500000,
                'frais' => 1500
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 500001,
                'max_montant' => 1000000,
                'frais' => 2500
            ],
            [
                'operation_type_id' => 3,
                'min_montant' => 1000001,
                'max_montant' => 2000000,
                'frais' => 3000
            ],
        ];

        foreach ($data as $row) {
            $this->db->table('frais_baremes')->insert($row);
        }

        echo "Barèmes de frais insérés avec succès !\n";
    }
}