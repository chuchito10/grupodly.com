<?php 
  @session_start();
  if(!class_exists('Connection')){
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Connection.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
  }if (!class_exists('DatosEnvio')) {
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Cliente/DatosEnvio.Model.php';
  }

  class DatosEnvioController{
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
          $DatosEnvio = new DatosEnvio();
          $DatosEnvio->SetParameters($this->conn, $this->Tool);
          $items = $DatosEnvio->Get($this->filter, $this->orderBy);
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
          $DatosEnvio = new DatosEnvio();
          $DatosEnvio->SetParameters($this->conn, $this->Tool);
          $DatosEnvio->SetDatosEnvioKey($this->Tool->validate_isset_post('DatosEnvioKey'));
          $DatosEnvio->SetNombre($this->Tool->validate_isset_post('Nombre'));
          $DatosEnvio->SetApellido($this->Tool->validate_isset_post('Apellido'));
          $DatosEnvio->SetCelular($this->Tool->validPhoneNumber('Celular', 'Celular', true));
          $DatosEnvio->SetTelefono($this->Tool->validPhoneNumber('Telefono', 'Teléfono', true));
          $DatosEnvio->SetCalle($this->Tool->validate_isset_post('Calle'));
          $DatosEnvio->SetNumeroExterior($this->Tool->validate_isset_post('NumeroExterior'));
          $DatosEnvio->SetNumeroInterior($this->Tool->validate_isset_post('NumeroInterior'));
          $DatosEnvio->SetCodigoPostal($this->Tool->validCodigoPostal('CodigoPostal', 'Codigo Postal', true));
          $DatosEnvio->SetEstado($this->Tool->validate_isset_post('Estado'));
          $DatosEnvio->SetMunicipio($this->Tool->validate_isset_post('Municipio'));
          $DatosEnvio->SetColonia($this->Tool->validate_isset_post('Colonia'));
          $DatosEnvio->SetReferencia($this->Tool->validate_isset_post('Referencia'));
          $DatosEnvio->SetActivo(1);
          $DatosEnvio->SetClienteKey($_SESSION['Ecommerce-ClienteKey']);
          return $ReturnJson ? json_encode($DatosEnvio->create(), JSON_UNESCAPED_UNICODE) : $DatosEnvio->create();
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
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionDatosEnvio'])) { 
    $DatosEnvioController = new DatosEnvioController();
    $DatosEnvioController->Controller();
    unset($DatosEnvioController);
  }
  unset($Tool);