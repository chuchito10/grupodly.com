<?php
@session_start();
if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
}if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Detalle.Controller.php';
}

class DetalleRoute{
    private $Tool;

    public function __construct(){
        $this->Tool = new Functions_tools();
    }

    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'create':
                    $DetalleController = new DetalleController();
                    $result = $DetalleController->AgregarArticuloPedido();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
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
    $DetalleRoute = new DetalleRoute();
    $DetalleRoute->Controller();
    unset($DetalleRoute);
  }
  unset($Tool);
    
?>