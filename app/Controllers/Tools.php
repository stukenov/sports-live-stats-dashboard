<?php

namespace App\Controllers;

class Tools extends BaseController
{
    public function prepare_db(): string
    {
        $forge = \Config\Database::forge();
        $forge->createDatabase('bigsportstat', true);
        

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
        $forge->createTable('disciplines', true);

        return 'Database prepared';
    }
}