<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'prefix' => '033',
                'description' => 'Airtel',
                'operateur_principal' => true,
            ],
            [
                'prefix' => '037',
                'description' => 'Orange',
                'operateur_principal' => false,
            ],
            [
                'prefix' => '034',
                'description' => 'Telma',
                'operateur_principal' => false,
            ],
        ];

        $this->db->table('prefixes')->insertBatch($data);
    }
}
