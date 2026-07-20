<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMobileMoney extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'prefix' => ['type' => 'VARCHAR', 'constraint' => 4, 'null' => false],
            'actif' => ['type' => 'BOOLEAN', 'default' => 1],
            'description' => ['type' => 'TEXT', 'null' => true],
            'operateur_principal' => ['type' => 'BOOLEAN', 'default' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('prefix');
        $this->forge->createTable('prefixes');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'telephone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => false],
            'solde' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'default' => 0.0],
            'prefix_id' => ['type' => 'INTEGER', 'null' => true],
            'date_creation' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('telephone');
        $this->forge->addForeignKey('prefix_id', 'prefixes', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('comptes');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'nom' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'description' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nom');
        $this->forge->createTable('operation_types');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'operation_type_id' => ['type' => 'INTEGER', 'null' => false],
            'min_montant' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => false],
            'max_montant' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => false],
            'frais' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('operation_type_id', 'operation_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('frais_baremes');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'compte_id_from' => ['type' => 'INTEGER', 'null' => true],
            'compte_id_to' => ['type' => 'INTEGER', 'null' => true],
            'operation_type_id' => ['type' => 'INTEGER', 'null' => false],
            'montant' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => false],
            'frais' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'default' => 0.0],
            'montant_total' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => false],
            'date_transaction' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'statut' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'succes'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('compte_id_from', 'comptes', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('compte_id_to', 'comptes', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('operation_type_id', 'operation_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions');

        $this->forge->addField([
            'id' => [ 'type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'prefix_source_id' => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned'   => true],
            'prefix_dest_id' => [ 'type'       => 'INTEGER', 'constraint' => 11, 'unsigned'   => true],
            'commission_pourcentage' => [ 'type' => 'DECIMAL', 'constraint' => '5,2','default' => 0.00],
            'date_cree' => [ 'type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('prefix_source_id', 'prefixes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('prefix_dest_id', 'prefixes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('commissions_inter');
    }

    public function down()
    {
        $this->forge->dropTable('transactions', true);
        $this->forge->dropTable('frais_baremes', true);
        $this->forge->dropTable('commissions_inter', true);
        $this->forge->dropTable('comptes', true);
        $this->forge->dropTable('operation_types', true);
        $this->forge->dropTable('prefixes', true);
    }
}
