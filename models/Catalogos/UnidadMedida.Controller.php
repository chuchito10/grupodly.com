<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Functions_tools.php';
}if (!class_exists("UnidadMedida")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Catalogos/UnidadMedida.Model.php';
}

  /**
   * 
   */
  class UnidadMedidaController{
    
    private $conn;
    private $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function get($return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $UnidadMedidaModel = new UnidadMedida(); 
          $UnidadMedidaModel->SetParameters($this->conn, $this->Tool);
          $items = $UnidadMedidaModel->Get($this->filter, $this->order);
          unset($UnidadMedidaModel);
          return $this->Tool->Message_return(false, "", $items, $return_json);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post('Action'); 
        switch ($Action) {
          case 'create':
            echo $this->create(true);
            break;
          default:
            throw new Exception("No se encuentra la opción solicitada");
            break;
        }
      } catch (Exception $e) {
        echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }

  }
  
   $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionUnidadMedida'])) { 
    $UnidadMedidaController = new UnidadMedidaController();
    $UnidadMedidaController->controller();
    unset($UnidadMedidaController);
  }
  unset($Tool);