<?php 

  /**
   * 
   */
  class File{

    public $FileKey;
    public $Descripcion;
    public $Path;
    public $Tipo;
    public $Estatus;

    protected $Connection;
    protected $Tool;
        
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function Get($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM t11_archivos ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $items = [];
        while ($row = $result->fetch_object()) {
          $File = new File();
          $File->FileKey      = $row->t11_pk01;
          $File->Descripcion  = $row->t11_f001;
          $File->Path         = $row->t11_f002;
          $File->Tipo         = $row->t11_f003;
          $File->Estatus      = $row->t11_f004;
          $items[] = $File;
        }
        unset($File);
        return $items;
      } catch (Exception $e) {
        throw $e;
      }
    }
    
  }

 ?>