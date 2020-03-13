<?php
class UnidadMedida{
    public $UnidadMedidaKey;
    public $Descripcion;
    public $Abreviacion;

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
    public function SetUnidadMedidaKey($UnidadMedidaKey){
        if(!is_numeric($UnidadMedidaKey)){
            throw new Exception('$UnidadMedidaKey debería de ser int');
        }
        $this->UnidadMedidaKey = $UnidadMedidaKey;
    }
    public function SetDescripcion($Descripcion){
        if(!is_string($Descripcion) || is_null($Descripcion)){
            throw new Exception('$Descripcion debería de ser string');
        }
        $this->Descripcion = $Descripcion;
    }
     public function SetAbreviacion($Abreviacion){
        if(!is_string($Abreviacion) || is_null($Abreviacion)){
            throw new Exception('$Abreviacion debería de ser string');
        }
        $this->Abreviacion = $Abreviacion;
    }

    public function Get($filter, $order){
        try {
            $SQLSTATEMENT = "SELECT * FROM t10_unidades_medida ".$filter." ".$order;
            // echo $SQLSTATEMENT;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = [];

            while ($row = $result->fetch_object()) {
                $UnidadMedida = new UnidadMedida();
                $UnidadMedida->UnidadMedidaKey  =   $row->t10_pk01;
                $UnidadMedida->Descripcion      =   $row->t10_f001;
                $UnidadMedida->Abreviacion      =   $row->t10_f002;
                $data[] = $UnidadMedida;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

?>