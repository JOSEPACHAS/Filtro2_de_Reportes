<?php
require_once '../tools/helpers.php';
require_once '../models/Alignment.php';
$alignment = new Alignment();

if (isset($_GET['op'])) {

  if ($_GET['op'] == 'listarBando') {
    renderJSON($alignment->listarBando());
  }
}
