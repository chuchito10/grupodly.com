<?php
@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Tools/Connection.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Tools/Functions_tools.php';
}if (!class_exists('Detalle')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Pedido/Detalle.Model.php';
}if (!class_exists('Pedido')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Pedido/Pedido.Model.php';
}if (!class_exists('Producto')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Productos/Producto.Model.php';
}

class DetalleController{
    private $Connection;
    private $Tool;
    private $PedidoModel;

    public function __construct(){
        $this->Connection = new Connection();
        $this->Tool = new Functions_tools();
        $this->DetalleModel =  new Detalle();
        $this->PedidoModel =  new Pedido();
        $this->ProductoModel =  new Producto();
    }
    public function SetParameters(){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    public function Get($JsonResult){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $this->DetalleModel->SetParameters($this->Connection, $this->Tool);
                $result = $this->DetalleModel->Get($_SESSION['Ecommerce-PedidoKey'],"");
                return $this->Tool->Message_return(false, "", $result, $JsonResult);
            }else{
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos", 1);
            }
        } catch (Exception $e) {
            throw new Exception("No se pudo obtener la información solicitada, si el problema persiste por favor contactanos", 1);
        }
    }
    public function getDetallePedido($JsonResult){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $this->DetalleModel->SetParameters($this->Connection, $this->Tool);
                $result = $this->DetalleModel->ListDetallePedido("WHERE t04_pk01 = ".$_SESSION['Ecommerce-PedidoKey']." ","");
                return $this->Tool->Message_return(false, "", $result, $JsonResult);
            }else{
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos", 1);
            }
        } catch (Exception $e) {
            throw new Exception("No se pudo obtener la información solicitada, si el problema persiste por favor contactanos", 1);
        }
    }
    public function AgregarArticuloPedido($JsonResult){
        if (!$this->Connection->conexion()->connect_error) {
            $this->DetalleModel->SetParameters($this->Connection, $this->Tool);
            $this->PedidoModel->SetParameters($this->Connection, $this->Tool);
            $this->ProductoModel->SetParameters($this->Connection, $this->Tool);
            if (!isset($_SESSION['Ecommerce-PedidoKey']) || empty($_SESSION['Ecommerce-PedidoKey'])) {
                // crear un nuevo pedido
                $this->PedidoModel->SetCliente(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
                $this->PedidoModel->SetSubTotal(0);
                $this->PedidoModel->SetIva(0.40);
                $this->PedidoModel->SetTotal(0);
                $this->PedidoModel->SetStatus(0);
                $result = $this->PedidoModel->Add();
                $_SESSION['Ecommerce-PedidoKey'] = $result['key'];
            }else{
                $this->PedidoModel->SetKey($_SESSION['Ecommerce-PedidoKey']);
            }
            // buscar el producto seleccionado
            $this->ProductoModel->SetCodigo($_POST['ProductoKey']);
            $Exists = $this->ProductoModel->GeyBy($this->ProductoModel->GetCodigo());
            
            // echo "Codigo".$this->ProductoModel->GetDescripcion();
            // verificar que exista el articulo
            if($Exists){
                // agregar producto al carrito
                // verificar existencia
                
                $this->DetalleModel->SetCantidad($_POST['ProductoCantidad']);
                $this->DetalleModel->SetEstatus(1);
                $this->DetalleModel->SetIva(0.40);
                $this->DetalleModel->SetItemCode($this->ProductoModel->GetProductoKey());
                $this->DetalleModel->SetPedido($_SESSION['Ecommerce-PedidoKey']);
                $this->DetalleModel->SetPrecioUnitario($this->ProductoModel->GetPrecio());
                $result = $this->DetalleModel->Add();
                // return $JsonResult ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result ;
                return $this->Tool->Message_return(false, "Producto agregado", null, $JsonResult);
            }else{
                return $this->Tool->Message_return(true, "No existe el producto : '".$this->ProductoModel->GetCodigo()."'", null, $JsonResult);
            }
            
        }else{
            throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos", 1);
        }
        
        
    }
    public function DeleteArticuloPedido($JsonResult){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $this->DetalleModel->SetParameters($this->Connection, $this->Tool);
                $this->DetalleModel->SetPedido($_SESSION['Ecommerce-PedidoKey']);
                $this->DetalleModel->SetItemCode($this->Tool->validate_isset_post('ProductoKey'));
                return $JsonResult ? json_encode($this->DetalleModel->Delete(), JSON_UNESCAPED_UNICODE) : $this->DetalleModel->Delete();
            }else{
                throw new Exception("No se pudo conectar!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'create':
                    echo $this->AgregarArticuloPedido(true);
                break;
                case 'delete':
                    echo $this->DeleteArticuloPedido(true);
                    break;
                default:
                    throw new Exception("No se encontro la opción solicitada, por favor contactanos");
                break;
            }
        } catch (Exception $e) {
            echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
        }
    }
}
  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionPedidoDetalle'])) { 
    $DetalleController = new DetalleController();
    $DetalleController->Controller();
    unset($DetalleController);
  }
  unset($Tool);
    
?>