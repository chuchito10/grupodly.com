<?php 

  /**
   * 
   */
  @session_start();
  if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Functions_tools.php';
  }if (!class_exists('LoginController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Login/Login.Controller.php';
  }

  class LoginRoute{
    
    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post("Action");
        switch ($Action) {
          case 'login':
            $LoginController = new LoginController();
            $LoginController->Correo = $this->Tool->validEmail("Email", "Correo", true);
            $LoginController->Password = $this->Tool->validDataString("Password", "Password", true);
            $Result = $LoginController->validateLogin();
            echo json_encode($Result, JSON_UNESCAPED_UNICODE);
            break;
          default:
            throw new Exception("No se encontro la opción solicitada, por favor contactanos.....");
            break;
        }
      } catch (Exception $e) {
        echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }
  }

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && $_POST['ActionLogin']) { 
    $LoginRoute = new LoginRoute();
    $LoginRoute->controller();
    unset($Tool);
  }