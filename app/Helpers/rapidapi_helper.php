<?php

function fetchFromRapidAPI($url, $query, $cacheKey)
{
    $cache = \Config\Services::cache();
    $cachedData = $cache->get($cacheKey);

    if (!is_null($cachedData)) {
        return $cachedData;
    } else {
        $client = \Config\Services::curlrequest();
        
        $response = $client->request('GET', $url, [
            'query' => $query,
            'headers' => [
                'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
                'X-RapidAPI-Host' => env('RAPIDAPI_HOST', 'livescore6.p.rapidapi.com')
            ],
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

function fetchDisciplineEndpoints($discipline)
{
    $cacheKey = 'discipline_endpoints_' . $discipline;
    $url = 'https://livescore6.p.rapidapi.com/leagues/v2/list';
    $query = ['Category' => $discipline];
    
    return fetchFromRapidAPI($url, $query, $cacheKey);
}

function fetchTableForLeagueByCategory($discipline, $league, $stage)
{
    $cacheKey = 'league_table_' . $discipline . '_' . $league . '_' . $stage;
    $url = 'https://livescore6.p.rapidapi.com/leagues/v2/get-table';
    $query = [
        'Category' => $discipline,
        'Ccd' => $league,
        'Scd' => $stage
    ];
    
    return fetchFromRapidAPI($url, $query, $cacheKey);
}

function fetchLeaguesList($discipline)
{
    $cacheKey = 'leagues_list_' . $discipline;
    $url = 'https://livescore6.p.rapidapi.com/leagues/v2/list';
    $query = ['Category' => $discipline];
    
    return fetchFromRapidAPI($url, $query, $cacheKey);
}

function fetchMatchesListLive($discipline)
{
    $cacheKey = 'matches_list_live_' . $discipline;
    $url = 'https://livescore6.p.rapidapi.com/matches/v2/list-live'; 
    $query = ['Category' => $discipline];

    return fetchFromRapidAPI($url, $query, $cacheKey);
    
}

function fetchMatchesListLiveByLeague($discipline, $league)
{
    $cacheKey = 'matches_list_live_by_league_' . $discipline . '_' . $league;
    $url = 'https://livescore6.p.rapidapi.com/matches/v2/list-live'; 
    $query = ['Category' => $discipline];

    $fetch = fetchFromRapidAPI($url, $query, $cacheKey);

    $responseArray = json_decode($fetch['apiResponse'], true);
    $stages = $responseArray['Stages'];
    $stage = array_filter($stages, function($item) use ($league) {
        return $item['Scd'] === $league;
    });

    $fetch['apiResponse'] = json_encode($stage);

    return $fetch;
}
