<?php

require_once 'Conexion.php';

class SuperHero extends Conexion{

  private $conexion;

  public function __construct(){
    $this->conexion = parent::getConexion();
  }

  public function listByPublisher($data = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_superhero_list_publisher(?)");
      $consulta->execute(
        array(
          $data['publisher_id']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listarFiltroSuperheroes($data = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_publisher_alignment_listar(?,?)");
      $consulta->execute(
        array(
          $data['publisher_id'],
          $data['alignment_id']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listarPublisherHeight($data = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_publisher_height_listar(?,?,?)");
      $consulta->execute(
        array(
          $data['publisher_id'],
          $data['height_min_cm'],
          $data['height_max_cm']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  
  public function listarPorRazas($data = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_superhero_listbyrace(?)");
      $consulta->execute(
        array(
          $data['race_id']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  

}

