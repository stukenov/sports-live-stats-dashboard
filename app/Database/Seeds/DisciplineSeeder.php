<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    public function run()
    {

        // Создает базу данных bigsportstat и таблицу disciplines
        // т.е. это первичный файл для инициализации БД
        // Сразу же загружает туда нужные минимальные данные

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

        $data = [
            'slug' => 'soccer',
            'name' => 'Футбол'
        ];

        $this->db->table('disciplines')->insert($data);

        $data = [
            'slug' => 'hockey',
            'name' => 'Хоккей'
        ];

        $this->db->table('disciplines')->insert($data);

        $data = [
            'slug' => 'basketball',
            'name' => 'Баскетбол'
        ];

        $this->db->table('disciplines')->insert($data);

        $data = [
            'slug' => 'tennis',
            'name' => 'Теннис'
        ];

        $this->db->table('disciplines')->insert($data);
        

    }
}