<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StagesSeeder extends Seeder
{
    public function run()
    {
        $forge = \Config\Database::forge();
        
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'discipline' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'league' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];

        $forge->addField($fields);
        $forge->addKey('id', true);
        $forge->createTable('stages', true);

    }
}