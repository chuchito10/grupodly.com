<?php 

  /**
   * 
   */
  class Comentarios{
    public $Key;
    public $Titulo;
    public $Descripcion;
    public $TotalEstrellas;
    public $ClienteKey;
    public $ProductoKey;

    private $conn;
    private $Tool;


    public function initial($conn, $Tool){
      $this->conn = $conn;
      $this->Tool = $Tool;
    }

    public function setKey($Key){
      if (!is_numeric($Key)) {
        throw new Exception('$Key deberia ser entero');
      }
      $this->Key = $Key;
    }

    public function setTitulo($Titulo){
      $this->Titulo = $Titulo;
    }

    public function setDescripcion($Descripcion){
      $this->Descripcion = $Descripcion;
    }

    public function setTotalEstrellas($TotalEstrellas){
      if (!is_numeric($TotalEstrellas)) {
        throw new Exception('$TotalEstrellas deberia ser entero');
      }
      $this->TotalEstrellas = $TotalEstrellas;
    }

    public function setClienteKey($ClienteKey){
      if (!is_numeric($ClienteKey)) {
        throw new Exception('$ClienteKey deberia ser entero');
      }
      $this->ClienteKey = $ClienteKey;
    }

    public function setProductoKey($ProductoKey){
      if (!is_numeric($ProductoKey)) {
        throw new Exception('$ProductoKey deberia ser entero');
      }
      $this->ProductoKey = $ProductoKey;
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM t09_comentarios_producto ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $items = [];
        while ($row = $result->fetch_object()) {
          $Comentarios = new Comentarios();
          $Comentarios->Key             = $row->t09_pk01;
          $Comentarios->Titulo          = $row->t09_f001;
          $Comentarios->Descripcion     = $row->t09_f002;
          $Comentarios->TotalEstrellas  = $row->t09_f003;
          $Comentarios->ClienteKey      = $row->t01_pk01;
          $Comentarios->ProductoKey     = $row->t06_pk01;
          $items[] = $Comentarios;
          unset($Comentarios);
        }
        return $items;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListProductoComentarios($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM list_producto_comentarios ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $items = [];
        while ($row = $result->fetch_object()) {
          $ResultRanking = (object)$this->ListProductoRanking("WHERE t06_pk01 = ".$row->t06_pk01." ", "GROUP BY t06_pk01")[0];
          
          $Comentarios = new Comentarios();
          $Comentarios->Key               = $row->t09_pk01;
          $Comentarios->Titulo            = $row->t09_f001;
          $Comentarios->Descripcion       = $row->t09_f002;
          $Comentarios->TotalEstrellas    = $row->t09_f003;
          $Comentarios->ClienteKey        = $row->t01_pk01;
          $Comentarios->ProductoKey       = $row->t06_pk01;
          $Comentarios->ClienteName       = empty($row->t06_pk01) ? 'Anonimo' : $row->t06_pk01;
          $Comentarios->Ranking           = $ResultRanking->Ranking;
          $Comentarios->TotalComentarios  = $ResultRanking->TotalComentarios;
          $items[] = $Comentarios;
          unset($ResultRanking);
          unset($Comentarios);
        }
        return $items;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListProductoRanking($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM list_producto_ranking ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $items = [];
        while ($row = $result->fetch_object()) {
          $items[] = $row;
        } 
        return $items;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function add(){
      try {
        $result = $this->conn->Exec_store_procedure_json("CALL ProductoComentarios(
          0,
          '".$this->Titulo."',
          '".$this->Descripcion."',
          ".$this->TotalEstrellas.",
          ".$this->ClienteKey.",
          ".$this->ProductoKey.",
          @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }

 ?>