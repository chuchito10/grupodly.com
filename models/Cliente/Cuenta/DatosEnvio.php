<?php 

/**
 * @autor: Jesus Herrera
 */

  @session_start();
  if (!class_exists("Connection")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Tools/Connection.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Tools/Functions_tools.php';
  }

  class DatosEnvio{
    
    public $ClienteKey;
    public $DatosEnvioKey;
    public $DatosEnvioActivo;
    public $DatosEnvioNombre = [
      "value" => "",
      "label" => "Nombre",
      "name" => "DatosEnvioNombre",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioApellido = [
      "value" => "",
      "label" => "Apellido",
      "name" => "DatosEnvioApellido",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioCelular = [
      "value" => "",
      "label" => "Celular",
      "name" => "DatosEnvioCelular",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioTelefono = [
      "value" => "",
      "label" => "Teléfono",
      "name" => "DatosEnvioTelefono",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioCalle = [
      "value" => "",
      "label" => "Calle",
      "name" => "DatosEnvioCalle",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioNumeroExt = [
      "value" => "",
      "label" => "Número exterior",
      "name" => "DatosEnvioNumeroExt",
      "required" => false,
      "type" => "text"
    ];
    public $DatosEnvioNumeroInt = [
      "value" => "",
      "label" => "Numero Interior",
      "name" => "DatosEnvioNumeroInt",
      "required" => false,
      "type" => "text"
    ];
    public $DatosEnvioCP = [
      "value" => "",
      "label" => "Código Postal",
      "name" => "DatosEnvioCP",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioEstado = [
      "value" => "",
      "label" => "Estado",
      "name" => "DatosEnvioEstado",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioMunicipio = [
      "value" => "",
      "label" => "Municipio",
      "name" => "DatosEnvioMunicipio",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioColonia = [
      "value" => "",
      "label" => "Colonia",
      "name" => "DatosEnvioColonia",
      "required" => true,
      "type" => "text"
    ];
    public $DatosEnvioReferencia = [
      "value" => "",
      "label" => "Referencia",
      "name" => "DatosEnvioReferencia",
      "required" => false,
      "type" => "text"
    ];

    private $conn;
    private $Tool;
  
    public function __construct(){
      $this->conn = new Connection();
      $this->Tool  = new Functions_tools();
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function get($filter, $order, $return_json){
      $items = [];
      if (!$this->conn->conexion()->connect_error) {
        try {
          $SQLSTATEMENT = "SELECT * FROM t02_datos_envio ".$filter." ".$order;
          // echo $SQLSTATEMENT;
          $result = $this->conn->QueryReturn($SQLSTATEMENT);
          while ($row =  $result->fetch_object()) {
            $DatosEnvio =  new DatosEnvio();
            $DatosEnvio->DatosEnvioKey                   =   $row->t02_pk01;
            $DatosEnvio->DatosEnvioNombre['value']       =   $row->t02_f001;
            $DatosEnvio->DatosEnvioApellido['value']     =   $row->t02_f002;
            $DatosEnvio->DatosEnvioCelular['value']      =   $row->t02_f003;
            $DatosEnvio->DatosEnvioTelefono['value']     =   $row->t02_f004;
            $DatosEnvio->DatosEnvioCalle['value']        =   $row->t02_f005;
            $DatosEnvio->DatosEnvioNumeroExt['value']    =   $row->t02_f006;
            $DatosEnvio->DatosEnvioNumeroInt['value']    =   $row->t02_f007;
            $DatosEnvio->DatosEnvioCP['value']           =   $row->t02_f008;
            $DatosEnvio->DatosEnvioEstado['value']       =   $row->t02_f009;
            $DatosEnvio->DatosEnvioMunicipio['value']    =   $row->t02_f010;
            $DatosEnvio->DatosEnvioColonia['value']      =   $row->t02_f011;
            $DatosEnvio->DatosEnvioReferencia['value']   =   $row->t02_f012;
            $DatosEnvio->DatosEnvioActivo                =   $row->t02_f013;
            $DatosEnvio->ClienteKey                      =   $row->t01_pk01;
            $items[] = $DatosEnvio;
          }
          unset($DatosEnvio);
          return $this->Tool->Message_return(false, "Datos obtenidos exitosamamente...", $items, $return_json);
        } catch (Exception $e) {
          throw $e; 
        }
      }
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function create($return_json){
      if (!$this->conn->conexion()->connect_error) {
        try {
          $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosEnvio(
            0,
            '".$this->DatosEnvioNombre['value']."',
            '".$this->DatosEnvioApellido['value']."',
            ".$this->DatosEnvioCelular['value'].",
            ".$this->DatosEnvioTelefono['value'].",
            '".$this->DatosEnvioCalle['value']."',
            '".$this->DatosEnvioNumeroExt['value']."',
            '".$this->DatosEnvioNumeroInt['value']."',
            ".$this->DatosEnvioCP['value'].",
            '".$this->DatosEnvioEstado['value']."',
            '".$this->DatosEnvioMunicipio['value']."',
            '".$this->DatosEnvioColonia['value']."',
            '".$this->DatosEnvioReferencia['value']."',
            ".$this->DatosEnvioActivo.",
            ".$this->ClienteKey.",
           @Result)", "@Result");
          return $return_json = true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
        } catch (Exception $e) {
          throw $e;
        }
      }
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function update($return_json){
      if (!$this->conn->conexion()->connect_error) {
        try {
          $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosEnvio(
            ".$this->DatosEnvioKey.",
            '".$this->DatosEnvioNombre['value']."',
            '".$this->DatosEnvioApellido['value']."',
            ".$this->DatosEnvioCelular['value'].",
            ".$this->DatosEnvioTelefono['value'].",
            '".$this->DatosEnvioCalle['value']."',
            '".$this->DatosEnvioNumeroExt['value']."',
            '".$this->DatosEnvioNumeroInt['value']."',
            ".$this->DatosEnvioCP['value'].",
            '".$this->DatosEnvioEstado['value']."',
            '".$this->DatosEnvioMunicipio['value']."',
            '".$this->DatosEnvioColonia['value']."',
            '".$this->DatosEnvioReferencia['value']."',
            ".$this->DatosEnvioActivo.",
            ".$this->ClienteKey.",
           @Result)", "@Result");
          return $return_json = true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
        } catch (Exception $e) {
          throw $e;
        }
      }
    }

    public function getVariables(){
      if (isset($_SESSION['Ecommerce-ClienteKey']) && is_numeric($_SESSION['Ecommerce-ClienteKey'])) {
        $this->ClienteKey              =  $_SESSION['Ecommerce-ClienteKey'];
        $this->DatosEnvioNombre['value']      =  $this->Tool->validDataString($this->DatosEnvioNombre['name'], $this->DatosEnvioNombre['label'], $this->DatosEnvioNombre['required']);
        $this->DatosEnvioApellido['value']    =  $this->Tool->validDataString($this->DatosEnvioApellido['name'], $this->DatosEnvioApellido['label'], $this->DatosEnvioApellido['required']);
        $this->DatosEnvioCelular['value']     =  $this->Tool->validPhoneNumber($this->DatosEnvioCelular['name'], $this->DatosEnvioCelular['label'], $this->DatosEnvioCelular['required']);
        $this->DatosEnvioTelefono['value']    =  $this->Tool->validPhoneNumber($this->DatosEnvioTelefono['name'], $this->DatosEnvioTelefono['label'], $this->DatosEnvioTelefono['required']);
        $this->DatosEnvioCalle['value']       =  $this->Tool->validDataString($this->DatosEnvioCalle['name'], $this->DatosEnvioCalle['label'], $this->DatosEnvioCalle['required']);
        $this->DatosEnvioNumeroExt['value']   =  $this->Tool->validDataString($this->DatosEnvioNumeroExt['name'], $this->DatosEnvioNumeroExt['label'], $this->DatosEnvioNumeroExt['required']);
        $this->DatosEnvioNumeroInt['value']   =  $this->Tool->validDataString($this->DatosEnvioNumeroInt['name'], $this->DatosEnvioNumeroInt['label'], $this->DatosEnvioNumeroInt['required']);
        $this->DatosEnvioCP['value']          =  $this->Tool->validCodigoPostal($this->DatosEnvioCP['name'], $this->DatosEnvioCP['label'], $this->DatosEnvioCP['required']);
        $this->DatosEnvioEstado['value']      =  $this->Tool->validDataString($this->DatosEnvioEstado['name'], $this->DatosEnvioEstado['label'], $this->DatosEnvioEstado['required']);
        $this->DatosEnvioMunicipio['value']      =  $this->Tool->validDataString($this->DatosEnvioMunicipio['name'], $this->DatosEnvioMunicipio['label'], $this->DatosEnvioMunicipio['required']);
        $this->DatosEnvioColonia['value']     =  $this->Tool->validDataString($this->DatosEnvioColonia['name'], $this->DatosEnvioColonia['label'], $this->DatosEnvioColonia['required']);
        $this->DatosEnvioReferencia['value']  =  $this->Tool->validDataString($this->DatosEnvioReferencia['name'], $this->DatosEnvioReferencia['label'], $this->DatosEnvioReferencia['required']);
        $this->DatosEnvioActivo      =  1;
      }else{
        throw new Exception("No se puede procesar tu solicitud, por favor contactanos!");
      }
    }

    public function controller(){
      try {
        $DatosEnvio = new DatosEnvio();
        $Action = $DatosEnvio->Tool->validate_isset_post("Action");

        switch ($Action) {
          case 'create':
            $DatosEnvio->getVariables();
            echo $DatosEnvio->create(true);
            break;
          case 'update':
            $DatosEnvio->DatosEnvioKey  =  $DatosEnvio->Tool->validate_isset_post("DatosEnvioKey");
            $DatosEnvio->getVariables();
            echo $DatosEnvio->update(true);
            break;
          default:
            throw new Exception("No se encontro la opción solicitada, por favor pide ayuda al departamento de TI");
            break;
        }

        unset($Datos);
      } catch (Exception $e) {
        echo $DatosEnvio->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }

  }
  
  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionDatosEnvio'])) { 
    DatosEnvio::controller();
    unset($Tool);
  }

