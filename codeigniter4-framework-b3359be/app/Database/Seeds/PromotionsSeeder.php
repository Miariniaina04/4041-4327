<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromotionsSeeder extends Seeder
{
    public function run()
    {
        $promotions = [
            ['operation_type_id' => 1, 'prom_pourcentage' => 1], // 033 → 032
            ['operation_type_id ' => 2, 'prom_pourcentage' => 2], // 033 → 031
            ['operation_type_id ' => 3, 'prom_pourcentage' => 3], // 037 → 032
        ];

        foreach ($promotions as $prom) {
            $this->db->table('promotions')->insert($prom);
        }
    }
}
