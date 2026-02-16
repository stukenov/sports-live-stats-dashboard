<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EndpointsSeeder extends Seeder
{
    public function run()
    {

        // Создает таблицу endpoints
        //  и загружает туда нужные минимальные данные

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
        $forge->createTable('endpoints', true);

        $data = [
            'slug' => 'matches',
            'name' => 'Матчи'
        ];

        $this->db->table('endpoints')->insert($data);

        $data = [
            'slug' => 'leagues',
            'name' => 'Лиги'
        ];

        $this->db->table('endpoints')->insert($data);

        $data = [
            'slug' => 'teams',
            'name' => 'Команды'
        ];

        $this->db->table('endpoints')->insert($data);

        

    }
}