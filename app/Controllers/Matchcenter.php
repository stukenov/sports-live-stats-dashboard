<?php

namespace App\Controllers;

use App\Models\Disciplines;
use App\Models\Endpoints;
use App\Models\LeaguesModel;
use App\Models\LeagueMatchesModel;
use App\Models\LeagueStagesModel;


class Matchcenter extends BaseController
{
    protected $disciplinesModel;
    protected $endpointsModel;

    public function __construct()
    {
        $this->disciplinesModel = new Disciplines();
        $this->endpointsModel = new Endpoints();
        $this->leaguesModel = new LeaguesModel();
        $this->leagueStagesModel = new LeagueStagesModel();
        $this->leagueMatchesModel = new LeagueMatchesModel();
    }
    
    public function list_of_disciplines()
    {
        $data = $this->disciplinesModel->getDisciplines();

        return view('templates/header')
            . view('matchcenter/list_of_disciplines', ['data' => $data])
            . view('templates/footer');
    }

    public function list_endpoints_for_disciplines(string $disciplineSlug = '')
    {
        $disciplinesData = $this->disciplinesModel->getDisciplines();
        $disciplineName = $disciplinesData[$disciplineSlug] ?? '';

        $endpointsData = $this->endpointsModel->getEndpoints();
        $data = ['endpoints' => $endpointsData];

        return view('templates/header')
            . view('matchcenter/list_endpoints_for_disciplines', [
                'discipline' => [
                    'slug' => $disciplineSlug, 
                    'name' => $disciplineName
                ]
            ] + $data)
            . view('templates/footer');
    }

    public function endpoints(string $disciplineSlug = '', string $endpointSlug = '')
    {
        $disciplinesData = $this->disciplinesModel->getDisciplines();
        $disciplineName = $disciplinesData[$disciplineSlug] ?? '';

        $endpointsData = $this->endpointsModel->getEndpoints();
        $endpointName = $endpointsData[$endpointSlug] ?? '';

        $leaguesModel = new LeaguesModel();
        $leagues = $leaguesModel->getLeagues($disciplineSlug);

        helper('rapidapi'); 
        
        $data = match ($endpointSlug) {
            'leagues' => $leagues,
            'matches' => fetchMatchesListLive($disciplineSlug),
            default => fetchDisciplineEndpoints($disciplineSlug),
        };

        if (!$endpointSlug == 'leagues'){
            session()->setFlashdata('apiResponse', $data['apiResponse']);}

        $viewName = $endpointSlug === 'matches' ? 'discipline_matches' : 'discipline_endpoints';

        return view('templates/header')
            . view("matchcenter/{$viewName}", [
                'discipline' => [
                    'slug' => $disciplineSlug, 
                    'name' => $disciplineName
                ],
                'endpoint' => [
                    'slug' => $endpointSlug, 
                    'name' => $endpointName
                ],
                'leagues' => $leagues
            ] + (array)$data)
            . view('templates/footer');
    }

    public function endpoints_first(string $disciplineSlug = '', string $endpointSlug = '', string $firstpointSlug = '')
    {
        $disciplinesData = $this->disciplinesModel->getDisciplines();
        $disciplineName = $disciplinesData[$disciplineSlug] ?? '';

        $endpointsData = $this->endpointsModel->getEndpoints();
        $endpointName = $endpointsData[$endpointSlug] ?? '';

        
        $leaguesModel = new LeaguesModel();
        $leagues = $leaguesModel->getLeagues($disciplineSlug);

        $leagueStages = $this->leagueStagesModel->getStages($firstpointSlug, $disciplineSlug);



        helper('rapidapi'); 

        $data = match ($endpointSlug) {
            'leagues' => $leagues,
            'matches' => fetchMatchesListLiveByLeague($disciplineSlug, $firstpointSlug),
            default => fetchDisciplineEndpoints($disciplineSlug),
        };

        // Добавляем информацию о firstpoint в массив данных
        $data['firstpoint'] = ['slug' => $firstpointSlug];

        if (!$endpointSlug == 'leagues'){
            session()->setFlashdata('apiResponse', $data['apiResponse']);}

        $viewName = $endpointSlug === 'matches' ? 'endpoints_matches' : 'endpoints_first';

        return view('templates/header')
            . view("matchcenter/{$viewName}", [
                'discipline' => [
                    'slug' => $disciplineSlug, 
                    'name' => $disciplineName
                ],
                'endpoint' => [
                    'slug' => $endpointSlug, 
                    'name' => $endpointName
                ],
                'firstpoint' => [
                    'slug' => $firstpointSlug
                ],
                'stages' => [
                    'name' => $leagueStages
                ]
            ] + (array)$data)
            . view('templates/footer');
    }

    public function endpoints_second(string $discipline = '', string $endpoint = '', string $firstpoint = '', string $secondpoint = '')
    {
        helper('rapidapi');
        $data = fetchTableForLeagueByCategory($discipline, $firstpoint, $secondpoint); 

        session()->setFlashdata('apiResponse', $data['apiResponse']);

        return view('templates/header')
            . view('matchcenter/endpoints_second', [
                'discipline' => $discipline, 
                'endpoint' => $endpoint, 
                'firstpoint' => $firstpoint, 
                'secondpoint' => $secondpoint
            ] + (array)$data)
            . view('templates/footer');
    }

    public function matches_list_for_league(string $disciplineSlug = '', string $endpointSlug = '', string $leagueSlug = '', string $stageSlug = '')
    {
        $matches = $this->leagueMatchesModel->getMatches($leagueSlug, $disciplineSlug, $stageSlug);

        return view('templates/header')
            . view('matchcenter/matches_list_for_league', [
                'discipline' => $disciplineSlug, 
                'endpoint' => $endpointSlug, 
                'league' => $leagueSlug, 
                'stage' => $stageSlug,
                'matches' => $matches
            ])
            . view('templates/footer');
    }
}


