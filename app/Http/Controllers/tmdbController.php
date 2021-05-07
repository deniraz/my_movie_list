<?php

require 'vendor/autoload.php';

use VfacTmdb\Factory;
use VfacTmdb\Search;
use VfacTmdb\Item;

// Initialize Wrapper
$tmdb = Factory::create()->getTmdb('481146c695450515f72f3ff886e39aeb');

// Search a movie
$search    = new Search($tmdb);
$responses = $search->movie('star wars');

// Get all results
foreach ($responses as $response)
{
    echo $response->getTitle();
}

// Get movie information
$item  = new Item($tmdb);
$infos = $item->getMovie(11, array('language' => 'fr-FR'));

echo $infos->getTitle();