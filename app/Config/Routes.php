<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// cli
$routes->cli('tools/prepare_db', 'Tools::prepare_db');

$routes->cli('parser/get_leagues_list_by_category/(:segment)', 'Parser::get_leagues_list_by_category/$1');
$routes->cli('parser/get_stages_list_by_category_and_leagues/(:segment)/(:segment)', 'Parser::get_stages_list_by_category_and_leagues/$1/$2');
$routes->cli('parser/get_matches_list_by_stages_leagues_discipline/(:segment)/(:segment)/(:segment)', 'Parser::get_matches_list_by_stages_leagues_discipline/$1/$2/$3');
$routes->cli('parser/init_parser', 'Parser::init_parser');

$routes->get('/matchcenter/(:segment)/(:segment)/(:segment)/(:segment)/matches', 'Matchcenter::matches_list_for_league/$1/$2/$3/$4');
$routes->get('/matchcenter/(:segment)/(:segment)/(:segment)/(:segment)', 'Matchcenter::endpoints_second/$1/$2/$3/$4');
$routes->get('/matchcenter/(:segment)/(:segment)/(:segment)', 'Matchcenter::endpoints_first/$1/$2/$3');
$routes->get('/matchcenter/(:segment)/(:segment)', 'Matchcenter::endpoints/$1/$2');
$routes->get('/matchcenter/(:segment)', 'Matchcenter::list_endpoints_for_disciplines/$1');
$routes->get('/matchcenter', 'Matchcenter::list_of_disciplines');


