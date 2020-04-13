<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Functions_tools.php';
}if (!class_exists("Cliente")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Cliente/Cliente.Model.php';
}

  /**
   * 
   */
  class ClienteController{
    
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
          $ClienteModel = new Cliente(); 
          $ClienteModel->SetParameters($this->conn, $this->Tool);
          $items = $ClienteModel->Get($this->filter, $this->order);
          unset($ClienteModel);
          return $this->Tool->Message_return(false, "", $items, $return_json);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function create(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ClienteModel = new Cliente();
          $ClienteModel->SetParameters($this->conn, $this->Tool);
          $ClienteModel->SetClienteKey($this->Tool->validate_isset_post("ClienteKey"));
          $ClienteModel->SetNombre($this->Tool->validate_isset_post("Nombre"));
          $ClienteModel->SetApellido($this->Tool->validate_isset_post("Apellido"));
          $ClienteModel->SetTelefono($this->Tool->validate_isset_post("Telefono"));
          $ClienteModel->SetPassword($this->Tool->validate_isset_post("ClientePassword"));
          $ClienteModel->SetPasswordConfirm($this->Tool->validate_isset_post("ClientePasswordConfirm"));
          $ClienteModel->SetCorreo($this->Tool->validate_isset_post("Correo"));
          return $ClienteModel->create();
        }else{

        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }