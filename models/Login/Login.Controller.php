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

class LoginController{

  protected $Connection;
  protected $Tool;

  public $Correo;
  public $Password;

  public function __construct(){
    $this->Connection = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * validación de login
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function validateLogin(){
    try{
      if(!$this->Connection->conexion()->connect_error){

        $result = array();
        $result = $this->Connection->Exec_store_procedure_json("CALL Login_(
            '".$this->Correo."',
            '".$this->Password."',
            @Result);","@Result");
        $ResultLoad = $this->load($result);
        return $result;
      }else{
        return $this->Tool->Message_return(true,"Error!!, No existe conexión",null, false);
      }
    }catch (Exception $e) {
      throw $e;
    }
  }
  /**
   * Información si el cliente ingreso satisfactoriamente 
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function load($result){
    try {
      if (!$result['error']) {
        $ClienteController = new ClienteController();
        $ClienteController->filter = "WHERE t01_f006 = '".$this->Correo."' ";
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


  
}