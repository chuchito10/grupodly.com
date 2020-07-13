<?php
    class Detalle{
        public $key;
        public $Subtotal;
        public $Iva;
        public $Total;
        public $Cantidad;
        public $Estatus;
        public $ItemCode;
        public $Pedido;
        public $PrecioUnitario;
        
        private $Connection;
        private $Tool;
        
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
        public function Setkey($key){
            if(!is_numeric($key) || is_null($key)){
                throw new Exception('$key debería de ser numero');
            }
            $this->key = $key;
        }
        public function SetSubtotal($Subtotal){
            $this->Subtotal = $Subtotal;
        }
        public function SetIva($Iva){
            $this->Iva = $Iva;
        }
        public function SetTotal($Total){
            $this->Total = $Total;
        }
        public function SetCantidad($Cantidad){
            if(!is_numeric($Cantidad) || is_null($Cantidad)){
                throw new Exception('$Cantidad debería de ser numero');
            }
            $this->Cantidad = $Cantidad;
        }
        public function SetEstatus($Estatus){
            $this->Estatus = $Estatus;
        }
        public function SetItemCode($ItemCode){
            $this->ItemCode = $ItemCode;
        }
        public function SetPedido($Pedido){
            $this->Pedido = $Pedido;
        }
        public function SetPrecioUnitario($PrecioUnitario){
            $this->PrecioUnitario = $PrecioUnitario;
        }
        public function Getkey(){
            return $this->key;
        }
        public function GetSubtotal(){
            return $this->Subtotal;
        }
        public function GetIva(){
            return $this->Iva;
        }
        public function GetTotal(){
            return $this->Total;
        }
        public function GetCantidad(){
            return $this->Cantidad;
        }
        public function GetEstatus(){
            return $this->Estatus;
        }
        public function GetItemCode(){
            return $this->ItemCode;
        }
        public function GetPedido(){
            return $this->Pedido;
        }
        public function GetPrecioUnitario(){
            return $this->PrecioUnitario;
        }
        public function Add(){
            try {
                //code...
                $result = $this->Connection->Exec_store_procedure_json("CALL PedidoDetalleAgregarProducto(
                    '".$this->Cantidad."',
                    '".$this->ItemCode."',
                    '".$this->Pedido."',
                @Result);", "@Result");
                return $result;
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function UpdateQuantity(){
            try {
                //code...
                $result = $this->Connection->Exec_store_procedure_json("CALL PedidoDetalleActualizarCantidadItem(
                    '".$this->Cantidad."',
                    '".$this->ItemCode."',
                    '".$this->Pedido."',
                @Result);", "@Result");
                return $result;
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function Delete(){
            try {
                //code...
                $result = $this->Connection->Exec_store_procedure_json("CALL PedidoDetalleEliminarProducto(
                    '".$this->ItemCode."',
                    '".$this->Pedido."',
                @Result);", "@Result");
                return $result;
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function Get($Pedido, $orderBy){
            try {
                $SQLSTATEMENT = "SELECT * FROM t05_pedido_detalle where t05_pk01 = ".$Pedido." ".$orderBy;
                // echo $SQLSTATEMENT;
                $result = $this->Connection->QueryReturn($SQLSTATEMENT);
                $data = array();
                while ($row = $result->fetch_object()) {
                    $newItem = new Detalle();
                    $newItem->key = $row->t05_pk01;
                    $newItem->Subtotal = $row->t05_f001;
                    $newItem->Iva = $row->t05_f002;
                    $newItem->Total = $row->t05_f003;
                    $newItem->Cantidad = $row->t05_f004;
                    $newItem->Estatus = $row->t05_f005;
                    $newItem->ItemCode = $row->t06_pk01;
                    $newItem->Pedido = $row->t04_pk01;
                    $newItem->PrecioUnitario = $row->t05_f006;
                    $data[] = $newItem;
                    unset($newItem);
                }
                return $data;
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function ListDetallePedido($filter, $orderBy){
            try {
                $SQLSTATEMENT = "SELECT * FROM list_detalle_pedido ".$filter." ".$orderBy;
                // echo $SQLSTATEMENT;
                $result = $this->Connection->QueryReturn($SQLSTATEMENT);
                $data = array();
                while ($row = $result->fetch_object()) {
                    $newItem = new Detalle();
                    $newItem->PedidoKey             = $row->t04_pk01;
                    $newItem->PedidoSubtotal        = $row->t04_f001;
                    $newItem->PedidoIva             = $row->t04_f002;
                    $newItem->PedidoTotal           = $row->t04_f003;
                    $newItem->PedidoFecha           = $row->t04_f003;

                    $newItem->Detallekey            = $row->t05_pk01;
                    $newItem->DetalleSubtotal       = $row->t05_f001;
                    $newItem->DetalleIva            = $row->t05_f002;
                    $newItem->DetalleTotal          = $row->t05_f003;
                    $newItem->DetalleCantidad       = $row->t05_f004;

                    $newItem->ProductoKey           = $row->id;
                    $newItem->ProductoCodigo        = $row->codigo;
                    $newItem->ProductoDescripcion   = $row->dsc_producto;
                    $newItem->ProductoImg           = $row->img;
                    $newItem->ProductoExistencia    = $row->cantidad;
                    $newItem->ProductoPrecio        = $row->costo;
                    $data[] = $newItem;
                    unset($newItem);
                }
                return $data;
            } catch (Exception $e) {
                throw $e;
            }
        }
    }


?>