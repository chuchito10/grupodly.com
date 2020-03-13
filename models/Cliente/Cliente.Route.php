<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/models/Tools/Functions_tools.php';
}if (!class_exists('ClienteController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/models/Cliente/Cliente.Controller.php';
}

class ClienteRoute{
  private $Tool;

  public function __construct(){
      $this->Tool = new Functions_tools();
  }

  public function controller(){
    try {
      $Action = $this->Tool->validate_isset_post("Action");
      switch ($Action) {
        case 'create':
          $ClienteController = new ClienteController();
          $Result = $ClienteController->create();
          echo json_encode($Result, JSON_UNESCAPED_UNICODE);
          break;
        default:
          throw new Exception("No se encontro la opción solicitada.....");
          break;
      }
    } catch (Exception $e) {
      echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
    }
  }

}

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionCliente'])) { 
    $ClienteRoute = new ClienteRoute();
    $ClienteRoute->controller();
    unset($ClienteRoute);
  }
  unset($Tool);