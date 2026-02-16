<?php

namespace App\Models;

use CodeIgniter\Model;

class LeagueMatchesModel extends Model
{
    protected $table = 'league_matches';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'slug', 'discipline', 'league', 'stage'];

    public function getMatches($leagueSlug, $disciplineSlug, $stageSlug)
    {
        return $this->where('league', $leagueSlug)
            ->where('discipline', $disciplineSlug)
            ->where('stage', $stageSlug)
            ->findAll();
    }
}