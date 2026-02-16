<?php

namespace App\Models;

use CodeIgniter\Model;

class Endpoints extends Model
{
    public function getEndpoints()
    {
       
        $this->db = \Config\Database::connect();
        $query = $this->db->table('endpoints')->get();
        $result = $query->getResultArray();
        $endpoints = [];
        foreach ($result as $row) {
            $endpoints[] = [
                'slug' => $row['slug'],
                'name' => $row['name']
            ];
        }
        return $endpoints;
    }
}
