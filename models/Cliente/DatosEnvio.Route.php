<?php 
  @session_start();
  if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
  }if (!class_exists('DatosEnvioController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/DatosEnvio.Controller.php';
  }

  class DatosEnvioRoute{
    private $Tool;
    
    public function __construct(){
      $this->Tool = new Functions_tools();
    }


    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post('Action');
        switch ($Action) {
          case 'create':
            $DatosEnvioController = new DatosEnvioController();
                $Result = $DatosEnvioController->create();
                echo json_encode($Result, JSON_UNESCAPED_UNICODE);
            break;
          default:
            throw new Exception("No se encuentra opción solicitada, por favor contactanos", 1);
            break;
        }
      } catch (Exception $e) {
        echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }
  }

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionDatosEnvio'])) { 
    $DatosEnvioRoute = new DatosEnvioRoute();
    $DatosEnvioRoute->Controller();
    unset($DatosEnvioRoute);
  }
  unset($Tool);