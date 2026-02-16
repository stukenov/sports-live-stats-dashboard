<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\RawSql;
use App\Models\Disciplines;

use App\Models\LeagueMatchesModel;


class Parser extends Controller
{
    private $header;

    public function __construct()
    {
        $this->header = [
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            'X-RapidAPI-Host' => env('RAPIDAPI_HOST', 'livescore6.p.rapidapi.com')
        ];
    }

    private function fetchFromRapidAPI($url, $query, $cacheKey)
    {
        $cache = \Config\Services::cache();
        $cachedData = $cache->get($cacheKey);

        if (!is_null($cachedData)) {
            return $cachedData;
        } else {
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', $url, [
                'query' => $query,
                'headers' => $this->header,
                'verify' => false
            ]);
            $data = [];
            if ($response->getStatusCode() === 200) {
                $data['apiResponse'] = $response->getBody();
                $cache->save($cacheKey, $data, 86400); // Кэширование на 24 часа
            } else {
                $data['apiResponse'] = 'Произошла ошибка при получении данных';
            }

            return $data;
        }
    }

    public function get_leagues_list_by_category($discipline)
    {
        $cacheKey = 'leagues_list_' . $discipline;
        $url = 'https://livescore6.p.rapidapi.com/leagues/v2/list';
        $query = ['Category' => $discipline];
        
        $fetchdata = $this->fetchFromRapidAPI($url, $query, $cacheKey);

        $data = [];
        $data = $fetchdata['apiResponse'];

        $ccg = json_decode($data);

        $db = \Config\Database::connect(); // Подключаемся один раз перед циклом

        foreach ($ccg as $value) {
            foreach ($value as $value2) {
                // Подготавливаем данные
                $name = $value2->Cnm;
                $slug = $value2->Ccd;

                // Используем подготовленное выражение для вставки
                $sql = "INSERT INTO leagues (name, slug, discipline) VALUES (?, ?, ?)";
                $db->query($sql, [$name, $slug, $discipline]);
                echo $db->affectedRows() . "\n"; // Выводим количество затронутых строк
            }
        }

        $ccg_result = $db->query('SELECT * FROM leagues')->getResultArray();
        
        return ($ccg_result);
    }

    public function get_stages_list_by_category_and_leagues($discipline, $league)
    {
        $cacheKey = 'leagues_list_' . $discipline;
        $url = 'https://livescore6.p.rapidapi.com/leagues/v2/list';
        $query = ['Category' => $discipline];
        
        $fetchdata = $this->fetchFromRapidAPI($url, $query, $cacheKey);

        $data = [];
        $data = $fetchdata['apiResponse'];

        $ccg = json_decode($data);

        $db = \Config\Database::connect(); // Подключаемся один раз перед циклом

        $stageData =[];
        foreach ($ccg as $value) 
        {
            foreach ($value as $value2) 
            {
                if ($value2->Ccd == $league) 
                {
                    foreach ($value2->Stages as $stages)
                    {
                        if ($stages->Shi == 0) 
                        {
                            $name = $stages->Sdn;
                            $slug = $stages->Scd;
                            $sql = "INSERT INTO stages (name, slug, discipline, league) VALUES (?, ?, ?, ?)";
                            $db->query($sql, [$name, $slug, $discipline, $league]);
                        }
                    }
                }
                
            }
        }

        $stages_result = $db->query('SELECT * FROM stages WHERE discipline = ? AND league = ?', [$discipline, $league])->getResultArray();

        return ($stages_result);
    }

    public function get_matches_list_by_stages_leagues_discipline($discipline, $league, $stage)
    {
        $cacheKey = 'matches_list_' . $discipline . '_' . $league . '_' . $stage;
        $url = 'https://livescore6.p.rapidapi.com/matches/v2/list-by-league';
        $query = [
            'Category' => $discipline,
            'Ccd' => $league,
            'Scd' => $stage,
            'Timezone' => '5'
        ];
        
        $fetchdata = $this->fetchFromRapidAPI($url, $query, $cacheKey);

        $data = [];
        $data = $fetchdata['apiResponse'];

        $ccg = json_decode($data);

        $db = \Config\Database::connect(); // Подключаемся один раз перед циклом

        $matchesData =[];
        foreach ($ccg as $value) 
        {
            foreach ($value as $value2) 
            {
                foreach ($value2->Events as $team) 
                {
                    $team1 = $team->T1;
                    $team2 = $team->T2;

                    foreach ($team1 as $team1Data) 
                    {
                        $team1Slug = $team1Data->Abr;
                        $team1Name = $team1Data->Nm;


                    }
                    foreach ($team2 as $team2Data) 
                    {
                        $team2Name = $team2Data->Nm;
                        $team2Slug = $team2Data->Abr;
                    }

                    $name = $team1Name . ' - ' . $team2Name;
                    $slug = strtolower($team1Slug) . '-' . strtolower($team2Slug);


                    $sql = "INSERT INTO league_matches (name, slug, discipline, league, stage) VALUES (?, ?, ?, ?, ?)";
                    $db->query($sql, [$name, $slug, $discipline, $league, $stage]); 


                    
                }
            }
        }

        
        return (var_dump($matchesData));
    }

    public function init_parser()
    {
        $disciplinesData = new Disciplines();
        
        // First connect to the database
        $db = \Config\Database::connect();

        $disciplines = $db->query('SELECT * FROM disciplines')->getResultArray();

        foreach ($disciplines as $discipline) {
            $leagues = $this->get_leagues_list_by_category($discipline['slug']);
            foreach ($leagues as $league) {
                $stages = $this->get_stages_list_by_category_and_leagues($discipline['slug'], $league['slug']);
                foreach ($stages as $stage) {
                    $matches = $this->get_matches_list_by_stages_leagues_discipline($discipline['slug'], $league['slug'], $stage['slug']);
                }
            }
        }

        return 'Парсинг завершен';
    }
}
