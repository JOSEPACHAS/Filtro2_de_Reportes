<?php

require_once '../tools/helpers.php';
require_once '../models/SuperHero.php';

$superhero = new SuperHero();

if(isset($_GET['op'])){
  
  if($_GET['op'] == 'listarCasas'){
    renderJSON($superhero->listByPublisher(['publisher_id' => $_GET['publisher_id']]));
  }

  if($_GET['op'] == 'listarFiltroSuperheroes'){
    renderJSON($superhero->listarFiltroSuperheroes(
      [
        'publisher_id' => $_GET['publisher_id'],
        'alignment_id' => $_GET['alignment_id']
      ]
    ));
  }
  
  if($_GET['op'] == 'listarPublisherHeight'){
    renderJSON($superhero->listarPublisherHeight(
      [
        'publisher_id' => $_GET['publisher_id'],
        'height_min_cm' => $_GET['height_min_cm'],
        'height_max_cm' => $_GET['height_max_cm']
      ]
    ));
  }
  if($_GET['op'] == 'listarPorRazas'){
    renderJSON($superhero->listarPorRazas(
      [
        'race_id' => $_GET['race_id']
      ]
    ));
  }
}


?>