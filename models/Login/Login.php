<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Functions_tools.php';
}if (!class_exists("ClienteController")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Cliente/Cliente.Controller.php';
}

class Login{

  private $conn;
  private $Tool;

  public $Email;
  public $Password;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * validación de login
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function validateLogin($return_json){
    try{
      if(!$this->conn->conexion()->connect_error){
        $result = array();
        $result = $this->conn->Exec_store_procedure_json("CALL Login(
            '".$this->Email."',
            '".$this->Password."',
            @Result);","@Result");
        $this->result = $result;
        $resultLoad = json_decode($this->load());
        if (!$resultLoad->error) {
          return $return_json == true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;  
        }else{
          return $this->load();
        }
      }else{
        return $this->Tools->Message_return(true,"Error!!, No existe conexión",null, $return_json);
      }
    }catch (Exception $e) {
      throw new Exception("Error al intentar iniciar sesión, validar Login", 1);
    }
  }
  /**
   * Información si el cliente ingreso satisfactoriamente 
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function load(){
    try {
      if (!$this->result['error']) {
        $ClienteController = new ClienteController();
        $ClienteController->filter = "WHERE t01_f006 = '".$this->Email."' ";
        $ClienteController->order = "";
        $ClienteController = $ClienteController->get(false);
        if ($ClienteController->count > 0) {
          $ClienteController = $ClienteController->records[0];
          $_SESSION['Ecommerce-ClienteKey']    = $ClienteController->ClienteKey;
          $_SESSION['Ecommerce-ClienteNombre'] = $ClienteController->Nombre.' '.$ClienteController->Apellido;
          $_SESSION['Ecommerce-ClienteEmail']  = $ClienteController->Correo;

          $date = date_create($ClienteController->FechaRegistro);
          $mes=date_format($date, 'm');
          $fecha=date_format($date, 'd-Y');
          $_SESSION['Ecommerce-ClienteFechaRegistro']  = $this->Tool->mes((int)$mes-1).', '.$fecha;
        }else{
          return $this->Tool->Message_return(true, "¡No se encuentra registrado aún!", null, true);
        }
        unset($ClienteController);
        return $this->Tool->Message_return(false, "¡Datos cliente encontrados exitosamente!", null, true);
      }else{
        return $this->Tool->Message_return(true, "No se puede iniciar sesión, por favor contactanos", null, true);
      }
    } catch (Exception $e) {
      throw new Exception("Error al intentar cargar información, load", 1);
    }
  }

  public static function controller(){
    try {
      $Login = new Login();
      $Action = $Login->Tool->validate_isset_post("Action");
      switch ($Action) {
        case 'login':
          $Login->Email     = $Login->Tool->validEmail("Email", "Correo", true);
          $Login->Password  = $Login->Tool->validate_isset_post("Password");
          echo $Login->validateLogin(true);
          break;
        default:
          throw new Exception("No se encontro la opción solicitada, por favor contactanos.....");
          break;
      }
    } catch (Exception $e) {
      echo $Login->Tool->Message_return(true, $e->getMessage(), null, true);
    }
  }

}


$Tool = new Functions_tools();
# Comprobación Autorización Ajax    
if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && $_POST['ActionLogin']) { 
  Login::controller();
  unset($Tool);
}