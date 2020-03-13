<?php
class Producto{
    public $ProductoKey;
    public $Codigo;
    public $Descripcion;
    public $Img;
    public $Ancho;
    public $Alto;
    public $Grosor;
    public $Existencia;
    public $Precio;
    public $CategoriaKey;
    public $ProveedorKey;
    public $UnidadMedidaKey;

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
    public function SetProductoKey($ProductoKey){
        if(!is_numeric($ProductoKey)){
            throw new Exception('$ProductoKey debería de ser int');
        }
        $this->ProductoKey = $ProductoKey;
    }
    public function SetCodigo($Codigo){
        if(!is_string($Codigo) || is_null($Codigo)){
            throw new Exception('$Codigo debería de ser string');
        }
        $this->Codigo = $Codigo;
    }
    public function SetDescripcion($Descripcion){
        $this->Descripcion = $Descripcion;
    }
    public function SetImg($Img){
        $this->Img = $Img;
    }
    public function SetAncho($Ancho){
        $this->Ancho = $Ancho;
    }
    public function SetAlto($Alto){
        $this->Alto = $Alto;
    }
    public function SetGrosor($Grosor){
        $this->Grosor = $Grosor;
    }
    public function SetExistencia($Existencia){
        $this->Existencia = $Existencia;
    }
    public function SetPrecio($Precio){
        $this->Precio = $Precio;
    }
    public function SetUnidadMedidaKey($UnidadMedidaKey){
        $this->UnidadMedidaKey = $UnidadMedidaKey;
    }
    public function SetCategoriaKey($CategoriaKey){
        $this->CategoriaKey = $CategoriaKey;
    }
    public function SetProveedorKey($ProveedorKey){
        $this->ProveedorKey = $ProveedorKey;
    }
    public function GetProductoKey(){
        return $this->ProductoKey;
    }
    public function GetCodigo(){
        return $this->Codigo;
    }
    public function GetDescripcion(){
        return $this->Descripcion;
    }
    public function GetImg(){
        return $this->Img;
    }
    public function GetAncho(){
        return $this->Ancho;
    }
    public function GetAlto(){
        return $this->Alto;
    }
    public function GetGrosor(){
        return $this->Grosor;
    }
    public function GetPrecio(){
        return $this->Precio;
    }
    public function GetExistencia(){
        return $this->Existencia;
    }
    public function GetUnidadMedidaKey(){
        return $this->UnidadMedidaKey;
    }
    public function GetCategoriaKey(){
        return $this->CategoriaKey;
    }
    public function GetProveedorKey(){
        return $this->ProveedorKey;
    }
    public function GeyBy($Producto){
        try {
            $SQLSTATEMENT = "SELECT * FROM t06_productos where t06_pk01 = '".$Producto."' ";
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = false;

            while ($row = $result->fetch_object()) {
                $this->ProductoKey   = $row->t06_pk01;
                $this->Codigo        = $row->t06_f001;
                $this->Descripcion   = $row->t06_f002;
                $this->Img           = $row->t06_f003;
                $this->Ancho         = $row->t06_f004;
                $this->Alto          = $row->t06_f005;
                $this->Grosor        = $row->t06_f006;
                $this->Existencia    = $row->t06_f007;
                $this->Precio        = $row->t06_f008;
                // $this->UnidadMedidaKey  = $row->t06_f009;
                // $this->CategoriaKey  = $row->t06_f011;
                // $this->ProveedorKey  = $row->t06_f012;
                $data = true;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function Get($filter, $order){
        try {
            $SQLSTATEMENT = "SELECT * FROM list_productos ".$filter." ".$order;
            // echo $SQLSTATEMENT;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = [];

            while ($row = $result->fetch_object()) {
                $Producto = new Producto();
                $Producto->ProductoKey              =   $row->t06_pk01;
                $Producto->Codigo                   =   $row->t06_f001;
                $Producto->Descripcion              =   $row->t06_f002;
                $Producto->Img                      =   $row->t06_f003;
                $Producto->Ancho                    =   $row->t06_f004;
                $Producto->Alto                     =   $row->t06_f005;
                $Producto->Grosor                   =   $row->t06_f006;
                $Producto->Existencia               =   $row->t06_f007;
                $Producto->Precio                   =   $row->t06_f008;
                $Producto->CategoriaKey             =   $row->t07_pk01;
                $Producto->CategoriaDescripcion     =   $row->t07_f001;
                $Producto->ProveedorKey             =   $row->t08_pk01;
                $Producto->ProveedorDescripcion     =   $row->t08_f001;
                $Producto->UnidadMedidaKey          =   $row->t10_pk01;
                $Producto->UnidadMedidaDescripcion  =   $row->t10_f001;
                $data[] = $Producto;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL ProductoCrear(
          ".$this->ProductoKey.",
          '".$this->Codigo."',
          '".$this->Descripcion."',
          '".$this->Img."',
          ".$this->Ancho.",
          ".$this->Alto.",
          ".$this->Grosor.",
          ".$this->Existencia.",
          ".$this->Precio.",
          ".$this->CategoriaKey.",
          ".$this->ProveedorKey.",
          ".$this->UnidadMedidaKey.",
          @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
}

?>