<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompteSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'telephone' => '0337208662',
                'prefix_id' => 1,
            ],
        ];

        $this->db->table('comptes')->insertBatch($data);
    }
}
