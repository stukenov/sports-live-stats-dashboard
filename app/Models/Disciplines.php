<?php

namespace App\Models;

use CodeIgniter\Model;

class Disciplines extends Model
{
    public function getDisciplines()
    {
        $this->db = \Config\Database::connect();

        $query = $this->db->table('disciplines')->get();
        $result = $query->getResultArray();
        $disciplines = [];

        foreach ($result as $row) {
            $disciplines[$row['slug']] = $row['name'];
        }
        return $disciplines;
    }
}
