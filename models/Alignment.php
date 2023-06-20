<?php

require_once 'Conexion.php';

class Alignment extends Conexion{

  private $conexion;

  public function __construct(){
    $this->conexion = parent::getConexion();
  }

  public function listarBando(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_alignment_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
