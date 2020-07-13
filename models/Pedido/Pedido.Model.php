<?php
class Pedido{

    private $Connection;
    private $Tool;
    
    public $Key;
    public $Cliente;
    public $SubTotal;
    public $Iva;
    public $Total;
    public $Estatus;
    public $Numeroguia;
    public $DatosEnvio;
    public $DatosFacturacion;
    public $ReferenciaOpenPay;
    
    public function __construct(){
      
    }
    
    public function SetParameters($conn, $Tool){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    private function StartObjects(){
        $this->Connection = new Connection();
        $this->Tool = new Functions_tools();
    }
    
    public function SetKey($Key){
        if(!is_numeric($Key)){
            throw new Exception('$Key debería de ser int');
        }
        $this->Key = $Key;
    }
    
    public function SetCliente($Cliente){
        if(!is_numeric($Cliente)){
            throw new Exception('$Cliente debería de ser int, valor recibido : '.$Cliente);
        }
        $this->Cliente = $Cliente;
    }
    
    public function SetSubTotal($SubTotal){
        if(!is_numeric($SubTotal)){
            throw new Exception('$SubTotal debería de ser int');
        }
        $this->SubTotal = $SubTotal;
    }
    
    public function SetIva($Iva){
        if(!is_numeric($Iva)){
            throw new Exception('$Iva debería de ser int');
        }
        $this->Iva = $Iva;
    }
    
    public function SetTotal($Total){
        if(!is_numeric($Total)){
            throw new Exception('$Key debería de ser int');
        }
        $this->Total = $Total;
    }
    
    public function SetStatus($Estatus){
        if(!is_numeric($Estatus)){
            throw new Exception('$Estatus debería de ser int');
        }
        $this->Estatus = $Estatus;
    }
    
    public function SetNumeroguia($Numeroguia){
        $this->Numeroguia = $Numeroguia;
    }
    
    public function SetDatosEnvio($DatosEnvio){
        if(!is_numeric($DatosEnvio)){
            throw new Exception('$DatosEnvio debería de ser int');
        }
        $this->DatosEnvio = $DatosEnvio;
    }
    
    public function SetDatosFacturacion($DatosFacturacion){
        if(!is_numeric($DatosFacturacion)){
            throw new Exception('$DatosFacturacion debería de ser int');
        }
        $this->DatosFacturacion = $DatosFacturacion;
    }
    public function SetReferenciaOpenPay($ReferenciaOpenPay){
        if(is_null($ReferenciaOpenPay)){
            throw new Exception('$ReferenciaOpenPay esta vacia');
        }
        $this->ReferenciaOpenPay = $ReferenciaOpenPay;
    }
    
    public function GetKey(){
      return $this->Key;
    }
    
    public function GetCliente(){
      return $this->Cliente;
    }
    
    public function GetSubTotal(){
      return $this->SubTotal;
    }
    
    public function GetIva(){
      return $this->Iva;
    }
    
    public function GetTotal(){
      return $this->Total;
    }
    
    public function GetStatus(){
      return $this->Status;
    }
    
    public function GetNumeroguia(){
      return $this->Numeroguia;
    }
    
    public function GetDatosEnvio(){
      return $this->DatosEnvio;
    }
    
    public function GetDatosFacturacion(){
      return $this->DatosFacturacion;
    }
    public function Add(){
        try {
            //code...
            $result = $this->Connection->Exec_store_procedure_json("CALL PedidoCrear_(
                '".$this->Key."',
                '".$this->Cliente."',
            @Result);", "@Result");
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function Update(){
        try {
            //code...
            $result = $this->Connection->Exec_store_procedure_json("CALL PedidoCrear(
                '".$this->Key."',
                '".$this->Cliente."',
                '".$this->SubTotal."',
                '".$this->Iva."',
                '".$this->Total."',
                '".$this->Estatus."',
                '".$this->Numeroguia."',
                '".$this->DatosEnvio."',
                '".$this->DatosFacturacion."',
            @Result);", "@Result");
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function UpdateReferencePago(){
        try {
            //code...
            $result = $this->Connection->Exec_store_procedure_json("CALL PedidoUpdateReferenciaOpenPay_(
                '".$this->Key."',
                '".$this->ReferenciaOpenPay."',
                '".$this->DatosEnvio."',
                '".$this->DatosFacturacion."',
            @Result);", "@Result");
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function Get($filter, $orderBy){
        try {
            $SQLSTATEMENT = "SELECT * FROM t04_pedido ".$filter." ".$orderBy;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = array();
            while ($row = $result->fetch_object()) {
                $newPedido = new Pedido();
                $newPedido->Key = $row->t04_pk01;
                $newPedido->Cliente = $row->t01_pk01;
                $newPedido->SubTotal = $row->t04_f001;
                $newPedido->Iva = $row->t04_f002;
                $newPedido->Total = $row->t04_f003;
                $newPedido->Estatus = $row->t04_f004;
                $newPedido->Numeroguia = $row->t04_f005;
                $newPedido->DatosEnvio = $row->t02_pk01;
                $newPedido->DatosFacturacion = $row->t03_pk01;
                $data[] = $newPedido;
                unset($newPedido);
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function GetBy($filter, $orderBy){
        try {
            $SQLSTATEMENT = "SELECT * FROM t04_pedido WHERE t04_pk01 = ".$filter." ".$orderBy;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = false;
            while ($row = $result->fetch_object()) {
                $this->Key = $row->t04_pk01;
                $this->Cliente = $row->t01_pk01;
                $this->SubTotal = $row->t04_f001;
                $this->Iva = $row->t04_f002;
                $this->Total = $row->t04_f003;
                $this->Estatus = $row->t04_f004;
                $this->Numeroguia = $row->t04_f005;
                $this->DatosEnvio = $row->t02_pk01;
                $this->DatosFacturacion = $row->t03_pk01;
                $data = true;
                unset($newPedido);
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }
}




?>