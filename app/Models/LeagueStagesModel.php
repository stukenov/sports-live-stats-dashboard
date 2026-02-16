<?php

namespace App\Models;

use CodeIgniter\Model;

class LeagueStagesModel extends Model
{
    protected $table = 'stages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['league', 'id', 'name', 'slug', 'discipline'];

    public function getStages($leagueSlug, $disciplineSlug)
    {
        return $this->where('league', $leagueSlug)
            ->where('discipline', $disciplineSlug)
            ->findAll();
    }
}