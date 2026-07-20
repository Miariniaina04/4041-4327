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
            ],
            [
                'prefix' => '037',
                'description' => 'Prefix secondaire',
            ],
        ];

        $this->db->table('prefixes')->insertBatch($data);
    }
}
