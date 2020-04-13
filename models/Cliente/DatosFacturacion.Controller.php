<?php 
  @session_start();
  if(!class_exists('Connection')){
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Connection.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
  }if (!class_exists('DatosFacturacion')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/DatosFacturacion.Model.php';
  }

  class DatosFacturacionController{
    private $conn;
    private $Tool;

    public $filter;
    public $orderBy;
    
    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }
    /**
     * 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function get($ReturnJson){
      try{
        if (!$this->conn->conexion()->connect_error) {
          $DatosFacturacion = new DatosFacturacion();
          $DatosFacturacion->SetParameters($this->conn, $this->Tool);
          $items = $DatosFacturacion->Get($this->filter, $this->orderBy);
          return $this->Tool->Message_return(false, "", $items, $ReturnJson);
        }else{
          throw new Exception("No se pueden obtener los datos maestros! por favor contactanos ");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function create($ReturnJson){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $DatosFacturacion = new DatosFacturacion();
          $DatosFacturacion->SetParameters($this->conn, $this->Tool);
          $DatosFacturacion->SetDatosFacturacionKey($this->Tool->validate_isset_post('DatosFacturacionKey'));
          $DatosFacturacion->SetRazonSocial($this->Tool->validate_isset_post('RazonSocial'));
          $DatosFacturacion->SetTipo($this->Tool->validate_isset_post('Tipo'));
          $DatosFacturacion->SetRFC($this->Tool->validRFC('RFC', 'RFC', true));
          $DatosFacturacion->SetCalle($this->Tool->validate_isset_post('Calle'));
          $DatosFacturacion->SetNumeroExterior($this->Tool->validate_isset_post('NumeroExterior'));
          $DatosFacturacion->SetNumeroInterior($this->Tool->validate_isset_post('NumeroInterior'));
          $DatosFacturacion->SetCodigoPostal($this->Tool->validCodigoPostal('CodigoPostal', 'Codigo Postal', true));
          $DatosFacturacion->SetEstado($this->Tool->validate_isset_post('Estado'));
          $DatosFacturacion->SetMunicipio($this->Tool->validate_isset_post('Municipio'));
          $DatosFacturacion->SetColonia($this->Tool->validate_isset_post('Colonia'));
          $DatosFacturacion->SetActivo(1);
          $DatosFacturacion->SetClienteKey($_SESSION['Ecommerce-ClienteKey']);
          return $ReturnJson ? json_encode($DatosFacturacion->create(), JSON_UNESCAPED_UNICODE) : $DatosFacturacion->create();
        }else{
          throw new Exception("No se pueden obtener los datos maestros! por favor contactanos ");
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
    $DatosFacturacionController = new DatosFacturacionController();
    $DatosFacturacionController->Controller();
    unset($DatosFacturacionController);
  }
  unset($Tool);