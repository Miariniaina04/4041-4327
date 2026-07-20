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
                'description' => 'Prefix principal',
                'operateur_principal' => true,
            ],
            [
                'prefix' => '037',
                'description' => 'Prefix secondaire',
                'operateur_principal' => false,
            ],
            [
                'prefix' => '034',
                'description' => 'Prefix teritaire',
                'operateur_principal' => false,
            ],
        ];

        $this->db->table('prefixes')->insertBatch($data);
    }
}
