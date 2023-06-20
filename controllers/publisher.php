<?php
require_once '../tools/helpers.php';
require_once '../models/Publisher.php';
$publisher = new Publisher();

if (isset($_GET['op'])) {

  if ($_GET['op'] == 'listar') {
    renderJSON($publisher->listAll());
  }

  if ($_GET['op'] == 'listarCasaDistribuidora') {
    renderJSON($publisher->listarCasaDistribuidora());
  }
}
