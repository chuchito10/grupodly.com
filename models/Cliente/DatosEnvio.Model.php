<?php 

  /**
   * 
   */
  class DatosEnvio{
    private $conn;
    private $Tool;

    public $DatosEnvioKey;
    public $Nombre;
    public $Apellido;
    public $Celular;
    public $Telefono;
    public $Calle;
    public $NumeroExterior;
    public $NumeroInterior;
    public $CodigoPostal;
    public $Estado;
    public $Municipio;
    public $Colonia;
    public $Referencia;
    public $Activo;
    public $ClienteKey;

    public function SetParameters($conn, $Tool){
      $this->conn = $conn;
      $this->Tool = $Tool;
    }

    public function SetDatosEnvioKey($DatosEnvioKey){
      if(!is_numeric($DatosEnvioKey) || is_null($DatosEnvioKey)){
        throw new Exception('$DatosEnvioKey debería de ser numero');
      }
      $this->DatosEnvioKey = $DatosEnvioKey;
    }

    public function SetNombre($Nombre){
      if(!is_string($Nombre) || is_null($Nombre)){
        throw new Exception('$Nombre debería de ser alfanumerico');
      }
      $this->Nombre = $Nombre;
    }

    public function SetApellido($Apellido){
      if(!is_string($Apellido) || is_null($Apellido)){
        throw new Exception('$Apellido debería de ser alfanumerico');
      }
      $this->Apellido = $Apellido;
    }

    public function SetCelular($Celular){
      if(!is_numeric($Celular) || is_null($Celular)){
        throw new Exception('$Celular debería de ser numero');
      }
      $this->Celular = $Celular;
    }

    public function SetTelefono($Telefono){
      if(!is_numeric($Telefono) || is_null($Telefono)){
        throw new Exception('$Telefono debería de ser numero');
      }
      $this->Telefono = $Telefono;
    }

    public function SetCalle($Calle){
      if(!is_string($Calle) || is_null($Calle)){
        throw new Exception('$Calle debería de ser alfanumerico');
      }
      $this->Calle = $Calle;
    }

    public function SetNumeroExterior($NumeroExterior){
      if(!is_string($NumeroExterior) || is_null($NumeroExterior)){
        throw new Exception('$NumeroExterior debería de ser alfanumerico');
      }
      $this->NumeroExterior = $NumeroExterior;
    }

    public function SetNumeroInterior($NumeroInterior){
      if(!is_string($NumeroInterior) || is_null($NumeroInterior)){
        throw new Exception('$NumeroInterior debería de ser alfanumerico');
      }
      $this->NumeroInterior = $NumeroInterior;
    }

    public function SetCodigoPostal($CodigoPostal){
      if(!is_numeric($CodigoPostal) || is_null($CodigoPostal)){
        throw new Exception('$CodigoPostal debería de ser numero');
      }
      $this->CodigoPostal = $CodigoPostal;
    }

    public function SetEstado($Estado){
      if(!is_string($Estado) || is_null($Estado)){
        throw new Exception('$Estado debería de ser alfanumerico');
      }
      $this->Estado = $Estado;
    }

    public function SetMunicipio($Municipio){
      if(!is_string($Municipio) || is_null($Municipio)){
        throw new Exception('$Municipio debería de ser alfanumerico');
      }
      $this->Municipio = $Municipio;
    }

    public function SetColonia($Colonia){
      if(!is_string($Colonia) || is_null($Colonia)){
        throw new Exception('$Colonia debería de ser alfanumerico');
      }
      $this->Colonia = $Colonia;
    }

    public function SetReferencia($Referencia){
      if(!is_string($Referencia) || is_null($Referencia)){
        throw new Exception('$Referencia debería de ser alfanumerico');
      }
      $this->Referencia = $Referencia;
    }

    public function SetActivo($Activo){
      if(!is_numeric($Activo) || is_null($Activo)){
        throw new Exception('$Activo debería de ser numero');
      }
      $this->Activo = $Activo;
    }

    public function SetClienteKey($ClienteKey){
      if(!is_numeric($ClienteKey) || is_null($ClienteKey)){
        throw new Exception('$ClienteKey debería de ser numero');
      }
      $this->ClienteKey = $ClienteKey;
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function Get($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM t02_datos_envio ".$filter." ".$orderBy;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = [];
        while ($row = $result->fetch_object()) {
          $DatosEnvio = new DatosEnvio();
          $DatosEnvio->DatosEnvioKey  = $row->t02_pk01;  
          $DatosEnvio->Nombre         = $row->t02_f001;  
          $DatosEnvio->Apellido       = $row->t02_f002;  
          $DatosEnvio->Celular        = $row->t02_f003;  
          $DatosEnvio->Telefono       = $row->t02_f004;  
          $DatosEnvio->Calle          = $row->t02_f005;  
          $DatosEnvio->NumeroExterior = $row->t02_f006;  
          $DatosEnvio->NumeroInterior = $row->t02_f007;  
          $DatosEnvio->CodigoPostal   = $row->t02_f008;  
          $DatosEnvio->Estado         = $row->t02_f009;  
          $DatosEnvio->Municipio      = $row->t02_f010;  
          $DatosEnvio->Colonia        = $row->t02_f011;  
          $DatosEnvio->Referencia     = $row->t02_f012;
          $DatosEnvio->Activo         = $row->t02_f013;
          $data[] = $DatosEnvio;
        }
        unset($DatosEnvio);  
        return $data;
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
    public function create(){
      try {
        $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosEnvio(
          ".$this->DatosEnvioKey.",
          '".$this->Nombre."',
          '".$this->Apellido."',
          ".$this->Celular.",
          ".$this->Telefono.",
          '".$this->Calle."',
          '".$this->NumeroExterior."',
          '".$this->NumeroInterior."',
          ".$this->CodigoPostal.",
          '".$this->Estado."',
          '".$this->Municipio."',
          '".$this->Colonia."',
          '".$this->Referencia."',
          ".$this->Activo.",
          ".$this->ClienteKey.",
        @Result)", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }

 ?>