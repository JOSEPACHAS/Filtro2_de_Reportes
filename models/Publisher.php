<?php

require_once 'Conexion.php';

class Publisher extends Conexion{

  private $conexion;

  public function __construct(){
    $this->conexion = parent::getConexion();
  }

  public function listAll(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_publisher_list()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listarCasaDistribuidora(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_publisher_name_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
