<?php
require_once '../tools/helpers.php';
require_once '../models/Race.php';
$race = new Race();

if (isset($_GET['op'])) {

  if ($_GET['op'] == 'listarRaza') {
    renderJSON($race->listarRaza());
  }
}
