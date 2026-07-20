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
                'solde' => 1000000,
            ],
        ];

        $this->db->table('comptes')->insertBatch($data);
    }
}
