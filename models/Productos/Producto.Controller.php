<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Tools/Functions_tools.php';
}if (!class_exists("Producto")) {
  include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Productos/Producto.Model.php';
}

  /**
   * 
   */
  class ProductoController{
    
    private $conn;
    private $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->Get($this->filter, $this->order);
          unset($ProductoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function create($return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto();
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $ProductoModel->SetProductoKey(0);
          $ProductoModel->SetCodigo($this->Tool->validate_isset_post('Codigo'));
          $ProductoModel->SetDescripcion($this->Tool->validate_isset_post('Descripcion'));
          $ProductoModel->SetImg($this->Tool->validate_isset_post('Codigo'));
          $ProductoModel->SetAncho($this->Tool->validate_isset_post('Ancho'));
          $ProductoModel->SetAlto($this->Tool->validate_isset_post('Alto'));
          $ProductoModel->SetGrosor($this->Tool->validate_isset_post('Grosor'));
          $ProductoModel->SetExistencia($this->Tool->validate_isset_post('Existencia'));
          $ProductoModel->SetPrecio($this->Tool->validate_isset_post('Precio'));
          $ProductoModel->SetCategoriaKey($this->Tool->validate_isset_post('CategoriaKey'));
          $ProductoModel->SetProveedorKey($this->Tool->validate_isset_post('ProveedorKey'));
          $ProductoModel->SetUnidadMedidaKey($this->Tool->validate_isset_post('UnidadMedidaKey'));
          $result = $ProductoModel->add();
          unset($ProductoModel);
          return $return_json ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result; 
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function update($return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto();
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $ProductoModel->SetProductoKey($this->Tool->validate_isset_post('ProductoKey'));
          $ProductoModel->SetCodigo($this->Tool->validate_isset_post('Codigo'));
          $ProductoModel->SetDescripcion($this->Tool->validate_isset_post('Descripcion'));
          $ProductoModel->SetImg($this->Tool->validate_isset_post('Codigo'));
          $ProductoModel->SetAncho($this->Tool->validate_isset_post('Ancho'));
          $ProductoModel->SetAlto($this->Tool->validate_isset_post('Alto'));
          $ProductoModel->SetGrosor($this->Tool->validate_isset_post('Grosor'));
          $ProductoModel->SetExistencia($this->Tool->validate_isset_post('Existencia'));
          $ProductoModel->SetPrecio($this->Tool->validate_isset_post('Precio'));
          $ProductoModel->SetCategoriaKey($this->Tool->validate_isset_post('CategoriaKey'));
          $ProductoModel->SetProveedorKey($this->Tool->validate_isset_post('ProveedorKey'));
          $ProductoModel->SetUnidadMedidaKey($this->Tool->validate_isset_post('UnidadMedidaKey'));
          $result = $ProductoModel->add();
          unset($ProductoModel);
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
          case 'update':
            echo $this->update(true);
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
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionProducto'])) { 
    $ProductoController = new ProductoController();
    $ProductoController->controller();
    unset($ProductoController);
  }
  unset($Tool);