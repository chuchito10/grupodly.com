<?php
class Proveedor{
    public $ProveedorKey;
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
    public function SetProveedorKey($ProveedorKey){
        if(!is_numeric($ProveedorKey)){
            throw new Exception('$ProveedorKey debería de ser int');
        }
        $this->ProveedorKey = $ProveedorKey;
    }
    public function SetDescripcion($Descripcion){
        if(!is_string($Descripcion) || is_null($Descripcion)){
            throw new Exception('$Descripcion debería de ser string');
        }
        $this->Descripcion = $Descripcion;
    }

    public function Get($filter, $order){
        try {
            $SQLSTATEMENT = "SELECT * FROM t08_proveedores ".$filter." ".$order;
            // echo $SQLSTATEMENT;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = [];

            while ($row = $result->fetch_object()) {
                $Proveedor = new Proveedor();
                $Proveedor->ProveedorKey  =   $row->t08_pk01;
                $Proveedor->Descripcion   =   $row->t08_f001;
                $data[] = $Proveedor;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

?>