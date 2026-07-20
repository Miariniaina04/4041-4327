<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperationTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom' => 'depot',
                'description' => 'Dépôt d\'argent',
            ],
            [
                'nom' => 'retrait',
                'description' => 'Retrait d\'argent',
            ],
            [
                'nom' => 'transfert',
                'description' => 'Transfert entre comptes',
            ],
        ];

        $this->db->table('operation_types')->insertBatch($data);
    }
}
