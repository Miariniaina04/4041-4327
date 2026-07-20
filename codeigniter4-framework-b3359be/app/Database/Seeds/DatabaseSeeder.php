<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('PrefixSeeder');
        $this->call('OperationTypeSeeder');
        $this->call('CompteSeeder');
        $this->call('FraisBaremeSeeder');
        $this->call('CommissionSeeder');
    }
}
