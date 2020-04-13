<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Functions_tools.php';
}if (!class_exists("Comentarios")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Productos/Comentarios.Model.php';
}

  /**
   * 
   */
  class ComentariosController{
    
    private $conn;
    private $Tool;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function get($return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ComentariosModel = new Comentarios(); 
          $ComentariosModel->initial($this->conn, $this->Tool);
          $items = $ComentariosModel->Get("", "");
          unset($ComentariosModel);
          return $this->Tool->Message_return(false, "", $items, $return_json);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function getProductoComentarios($Id, $return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ComentariosModel = new Comentarios(); 
          $ComentariosModel->initial($this->conn, $this->Tool);
          $items = $ComentariosModel->ListProductoComentarios("WHERE t06_pk01 = ".$Id." ", "");
          unset($ComentariosModel);
          return $this->Tool->Message_return(false, "", $items, $return_json);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function create($return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ComentariosModel = new Comentarios();
          $ComentariosModel->initial($this->conn, $this->Tool);
          $ComentariosModel->setTitulo($this->Tool->validate_isset_post('Titulo'));
          $ComentariosModel->setDescripcion($this->Tool->validate_isset_post('Descripcion'));
          $ComentariosModel->setTotalEstrellas($this->Tool->validate_isset_post('TotalEstrellas'));
          $ComentariosModel->setClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          $ComentariosModel->setProductoKey($this->Tool->validate_isset_post('ProductoKey'));
          $result = $ComentariosModel->add();
          unset($ComentariosModel);
          return $return_json ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result; 
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
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionComentarios'])) { 
    $ComentariosController = new ComentariosController();
    $ComentariosController->controller();
    unset($ComentariosController);
  }
  unset($Tool);