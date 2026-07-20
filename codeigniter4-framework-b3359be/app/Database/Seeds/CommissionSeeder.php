<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommissionSeeder extends Seeder
{
    public function run()
    {
        $commissions = [
            ['prefix_source_id' => 1, 'prefix_dest_id' => 2, 'commission_pourcentage' => 1.5], // 033 → 032
            ['prefix_source_id' => 1, 'prefix_dest_id' => 3, 'commission_pourcentage' => 2.0], // 033 → 031
            ['prefix_source_id' => 2, 'prefix_dest_id' => 3, 'commission_pourcentage' => 1.0], // 037 → 032
        ];

        foreach ($commissions as $com) {
            $this->db->table('commissions_inter')->insert($com);
        }
    }
}
