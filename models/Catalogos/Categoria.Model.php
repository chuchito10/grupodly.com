<?php
class Categoria{
    public $CategoriaKey;
    public $Descripcion;

    protected $Connection;
    protected $Tool;
        
    public function __construct(){
    
    }
    public function SetParameters($conn, $Tool){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    private function StartObjects(){
        $this->conn = new Connection();
        $this->Tool = new Functions_tools();
    }
    public function SetCategoriaKey($CategoriaKey){
        if(!is_numeric($CategoriaKey)){
            throw new Exception('$CategoriaKey debería de ser int');
        }
        $this->CategoriaKey = $CategoriaKey;
    }
    public function SetDescripcion($Descripcion){
        if(!is_string($Descripcion) || is_null($Descripcion)){
            throw new Exception('$Descripcion debería de ser string');
        }
        $this->Descripcion = $Descripcion;
    }

    public function Get($filter, $order){
        try {
            $SQLSTATEMENT = "SELECT * FROM t07_categorias ".$filter." ".$order;
            // echo $SQLSTATEMENT;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = [];

            while ($row = $result->fetch_object()) {
                $Categoria = new Categoria();
                $Categoria->CategoriaKey  =   $row->t07_pk01;
                $Categoria->Descripcion   =   $row->t07_f001;
                $data[] = $Categoria;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

?>