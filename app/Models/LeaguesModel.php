<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class LeaguesModel extends Model
{

    protected $allowedFields = ['slug', 'name'];
    
    public function getLeagues($disciplineSlug)
    {
        $query = $this->db->table('leagues')->where('discipline', $disciplineSlug)->get();
        $result = $query->getResultArray();
        $leagues = [];
        foreach ($result as $row) {
            $leagues[] = [
                'slug' => $row['slug'],
                'name' => $row['name']
            ];
        }
        return $leagues;
    }


}