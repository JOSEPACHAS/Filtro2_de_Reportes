<?php

require_once 'Conexion.php';

class Race extends Conexion{

  private $conexion;

  public function __construct(){
    $this->conexion = parent::getConexion();
  }

  public function listarRaza(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_race_list()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}