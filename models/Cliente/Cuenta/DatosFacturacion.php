<?php 

  /**
   * 
   */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/models/Tools/Functions_tools.php';
}

  class DatosFacturacion{
    
    public $ClienteKey;
    public $DatosFacturacionKey;
    public $DatosFacturacionActivo;
    public $DatosFacturacionRazonSocial = [
      "value" => "",
      "label" => "Razón Social",
      "name" => "DatosFacturacionRazonSocial",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionTipo = [
      "value" => "",
      "label" => "Tipo Factura",
      "name" => "DatosFacturacionTipo",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionRFC = [
      "value" => "",
      "label" => "RFC",
      "name" => "DatosFacturacionRFC",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionCalle = [
      "value" => "",
      "label" => "Calle",
      "name" => "DatosFacturacionCalle",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionNumeroExt = [
      "value" => "",
      "label" => "Número exterior",
      "name" => "DatosFacturacionNumeroExt",
      "required" => false,
      "type" => "text"
    ];
    public $DatosFacturacionNumeroInt = [
      "value" => "",
      "label" => "Numero Interior",
      "name" => "DatosFacturacionNumeroInt",
      "required" => false,
      "type" => "text"
    ];
    public $DatosFacturacionCP = [
      "value" => "",
      "label" => "Código Postal",
      "name" => "DatosFacturacionCP",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionEstado = [
      "value" => "",
      "label" => "Estado",
      "name" => "DatosFacturacionEstado",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionMunicipio = [
      "value" => "",
      "label" => "Municipio",
      "name" => "DatosFacturacionMunicipio",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionDelegacion = [
      "value" => "",
      "label" => "Delegación",
      "name" => "DatosFacturacionDelegacion",
      "required" => true,
      "type" => "text"
    ];
    public $DatosFacturacionColonia = [
      "value" => "",
      "label" => "Colonia",
      "name" => "DatosFacturacionColonia",
      "required" => true,
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
          $SQLSTATEMENT = "SELECT * FROM t03_datos_facturacion ".$filter." ".$order;
          // echo $SQLSTATEMENT;
          $result = $this->conn->QueryReturn($SQLSTATEMENT);
          while ($row =  $result->fetch_object()) {
            $DatosFacturacion =  new DatosFacturacion();
            $DatosFacturacion->DatosFacturacionKey                   =   $row->t03_pk01;
            $DatosFacturacion->DatosFacturacionRazonSocial['value']  =   $row->t03_f001;
            $DatosFacturacion->DatosFacturacionTipo['value']         =   $row->t03_f002;
            $DatosFacturacion->DatosFacturacionRFC['value']          =   $row->t03_f003;
            $DatosFacturacion->DatosFacturacionCalle['value']        =   $row->t03_f004;
            $DatosFacturacion->DatosFacturacionNumeroExt['value']    =   $row->t03_f005;
            $DatosFacturacion->DatosFacturacionNumeroInt['value']    =   $row->t03_f006;
            $DatosFacturacion->DatosFacturacionCP['value']           =   $row->t03_f007;
            $DatosFacturacion->DatosFacturacionEstado['value']       =   $row->t03_f008;
            $DatosFacturacion->DatosFacturacionMunicipio['value']    =   $row->t03_f009;
            $DatosFacturacion->DatosFacturacionColonia['value']      =   $row->t03_f010;
            $DatosFacturacion->DatosFacturacionActivo                =   $row->t03_f011;
            $DatosFacturacion->ClienteKey                            =   $row->t01_pk01;
            $items[] = $DatosFacturacion;
          }
          unset($DatosFacturacion);
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
          $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosFacturacion(
            0,
            '".$this->DatosFacturacionRazonSocial['value']."',
            '".$this->DatosFacturacionTipo['value']."',
            '".$this->DatosFacturacionRFC['value']."',
            '".$this->DatosFacturacionCalle['value']."',
            '".$this->DatosFacturacionNumeroExt['value']."',
            '".$this->DatosFacturacionNumeroInt['value']."',
            '".$this->DatosFacturacionCP['value']."',
            '".$this->DatosFacturacionEstado['value']."',
            '".$this->DatosFacturacionMunicipio['value']."',
            '".$this->DatosFacturacionColonia['value']."',
            '".$this->DatosFacturacionActivo."',
            ".$this->ClienteKey.",
           @Result);", "@Result");
          return $return_json = true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
        } catch (Exception $e) {
          throw $e;
        }
      }
    }

    public function update($return_json){
      if (!$this->conn->conexion()->connect_error) {
        try {
          $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosFacturacion(
            ".$this->DatosFacturacionKey.",
            '".$this->DatosFacturacionRazonSocial['value']."',
            '".$this->DatosFacturacionTipo['value']."',
            '".$this->DatosFacturacionRFC['value']."',
            '".$this->DatosFacturacionCalle['value']."',
            '".$this->DatosFacturacionNumeroExt['value']."',
            '".$this->DatosFacturacionNumeroInt['value']."',
            '".$this->DatosFacturacionCP['value']."',
            '".$this->DatosFacturacionEstado['value']."',
            '".$this->DatosFacturacionMunicipio['value']."',
            '".$this->DatosFacturacionColonia['value']."',
            '".$this->DatosFacturacionActivo."',
            ".$this->ClienteKey.",
           @Result);", "@Result");
          return $return_json = true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
        } catch (Exception $e) {
          throw $e;
        }
      }
    }

    public function getVariables(){
      if (isset($_SESSION['Ecommerce-ClienteKey']) && is_numeric($_SESSION['Ecommerce-ClienteKey'])) {
        $this->ClienteKey                            =  $_SESSION['Ecommerce-ClienteKey'];
        $this->DatosFacturacionRazonSocial['value']    =  $this->Tool->validDataString($this->DatosFacturacionRazonSocial['name'], $this->DatosFacturacionRazonSocial['label'], $this->DatosFacturacionRazonSocial['required']);
        $this->DatosFacturacionTipo['value']           =  $this->Tool->validDataString($this->DatosFacturacionTipo['name'], $this->DatosFacturacionTipo['label'], $this->DatosFacturacionTipo['required']);
        $this->DatosFacturacionRFC['value']            =  $this->Tool->validRFC($this->DatosFacturacionRFC['name'], $this->DatosFacturacionRFC['label'], $this->DatosFacturacionRFC['required']);
        $this->DatosFacturacionCalle['value']       =  $this->Tool->validDataString($this->DatosFacturacionCalle['name'], $this->DatosFacturacionCalle['label'], $this->DatosFacturacionCalle['required']);
        $this->DatosFacturacionNumeroExt['value']   =  $this->Tool->validDataString($this->DatosFacturacionNumeroExt['name'], $this->DatosFacturacionNumeroExt['label'], $this->DatosFacturacionNumeroExt['required']);
        $this->DatosFacturacionNumeroInt['value']   =  $this->Tool->validDataString($this->DatosFacturacionNumeroInt['name'], $this->DatosFacturacionNumeroInt['label'], $this->DatosFacturacionNumeroInt['required']);
        $this->DatosFacturacionCP['value']          =  $this->Tool->validCodigoPostal($this->DatosFacturacionCP['name'], $this->DatosFacturacionCP['label'], $this->DatosFacturacionCP['required']);
        $this->DatosFacturacionEstado['value']      =  $this->Tool->validDataString($this->DatosFacturacionEstado['name'], $this->DatosFacturacionEstado['label'], $this->DatosFacturacionEstado['required']);
        $this->DatosFacturacionMunicipio['value']      =  $this->Tool->validDataString($this->DatosFacturacionMunicipio['name'], $this->DatosFacturacionMunicipio['label'], $this->DatosFacturacionMunicipio['required']);
        $this->DatosFacturacionColonia['value']     =  $this->Tool->validDataString($this->DatosFacturacionColonia['name'], $this->DatosFacturacionColonia['label'], $this->DatosFacturacionColonia['required']);
        $this->DatosFacturacionActivo      =  1;
      }else{
        throw new Exception("No se puede procesar tu solicitud, por favor contactanos!");
      }
    }

    public function controller(){
      try {
        $DatosFacturacion = new DatosFacturacion();
        $Action = $DatosFacturacion->Tool->validate_isset_post("Action");

        switch ($Action) {
          case 'get':
            $DatosFacturacion->DatosFacturacionKey  =  $DatosFacturacion->Tool->validate_isset_post("DatosFacturacionKey");
            echo $DatosFacturacion->get("WHERE id_cliente = ".$DatosFacturacion->DatosFacturacionKey." ", "", true);
            break;
          case 'create':
            $DatosFacturacion->getVariables();
            echo $DatosFacturacion->create(true);
            break;
          case 'update':
            $DatosFacturacion->DatosFacturacionKey  =  $DatosFacturacion->Tool->validate_isset_post("DatosFacturacionKey");
            $DatosFacturacion->getVariables();
            echo $DatosFacturacion->update(true);
            break;
          default:
            throw new Exception("No se encontro la opción solicitada, por favor pide ayuda al departamento de TI");
            break;
        }
        unset($Cliente);
      } catch (Exception $e) {
        echo $DatosFacturacion->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }

  }
  
   $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_REQUEST['ActionDatosFacturacion'])) { 
    DatosFacturacion::controller();
    unset($Tool);
  }