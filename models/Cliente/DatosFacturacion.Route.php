<?php 
  @session_start();
  if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
  }if (!class_exists('DatosFacturacionController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/DatosFacturacion.Controller.php';
  }

  class DatosFacturacionRoute{
    private $Tool;
    
    public function __construct(){
      $this->Tool = new Functions_tools();
    }


    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post('Action');
        switch ($Action) {
          case 'create':
            $DatosFacturacionController = new DatosFacturacionController();
                $Result = $DatosFacturacionController->create();
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
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionDatosFacturacion'])) { 
    $DatosFacturacionRoute = new DatosFacturacionRoute();
    $DatosFacturacionRoute->Controller();
    unset($DatosFacturacionRoute);
  }
  unset($Tool);