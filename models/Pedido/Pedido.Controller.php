<?php
@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Connection.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
}if (!class_exists('Pedido')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Pedido.Model.php';
}
class PedidoController{
    private $Connection;
    private $Tool;
    private $PedidoModel;

    public $filter;

    public function __construct(){
        $this->Connection = new Connection();
        $this->Tool = new Functions_tools();
        $this->PedidoModel =  new Pedido();
    }
    public function SetParameters(){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    public function GetBy(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $this->PedidoModel->SetParameters($this->Connection, $this->Tool);
                $result = $this->PedidoModel->GetBy($_SESSION['Ecommerce-PedidoKey'],"");
                return $this->PedidoModel;
            }else{
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
            }
        } catch (Exception $e) {
            throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
        }
    }
    public function Get($JsonResult){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $this->PedidoModel->SetParameters($this->Connection, $this->Tool);
                $this->filter = empty($this->filter) ? "" : $this->filter;
                $result = $this->PedidoModel->Get($this->filter,"");
                return $this->Tool->Message_return(false, "", $result, $JsonResult);
            }else{
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
            }
        } catch (Exception $e) {
            throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
        }
    }
    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'List':
                    echo $this->List(true);
                break;
                default:
                    throw new Exception("No se encontro la opción solictada, por favor contactanos");
                break;
            }
        } catch (Exception $e) {
            echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
        }
    }
}

    $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionPedido'])) { 
    $PedidoController = new PedidoController();
    $PedidoController->Controller();
    unset($PedidoController);
  }
  unset($Tool);
?>