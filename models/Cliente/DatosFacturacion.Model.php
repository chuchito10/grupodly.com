<?php 

  /**
   * 
   */
  class DatosFacturacion{
    private $conn;
    private $Tool;

    public $DatosFacturacionKey;
    public $RazonSocial;
    public $Tipo;
    public $RFC;
    public $Calle;
    public $NumeroExterior;
    public $NumeroInterior;
    public $CodigoPostal;
    public $Estado;
    public $Municipio;
    public $Colonia;
    public $Activo;
    public $ClienteKey;

    public function SetParameters($conn, $Tool){
      $this->conn = $conn;
      $this->Tool = $Tool;
    }

    public function SetDatosFacturacionKey($DatosFacturacionKey){
      if(!is_numeric($DatosFacturacionKey) || is_null($DatosFacturacionKey)){
        throw new Exception('$DatosFacturacionKey debería de ser numero');
      }
      $this->DatosFacturacionKey = $DatosFacturacionKey;
    }

    public function SetRazonSocial($RazonSocial){
      if(!is_string($RazonSocial) || is_null($RazonSocial)){
        throw new Exception('$RazonSocial debería de ser alfanumerico');
      }
      $this->RazonSocial = $RazonSocial;
    }

    public function SetTipo($Tipo){
      if(!is_string($Tipo) || is_null($Tipo)){
        throw new Exception('$Tipo debería de ser alfanumerico');
      }
      $this->Tipo = $Tipo;
    }

    public function SetRFC($RFC){
      if(!is_numeric($RFC) || is_null($RFC)){
        throw new Exception('$RFC debería de ser numero');
      }
      $this->RFC = $RFC;
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
        $SQLSTATEMENT = "SELECT * FROM t03_datos_facturacion ".$filter." ".$orderBy;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = [];
        while ($row = $result->fetch_object()) {
          $DatosFacturacion = new DatosFacturacion();
          $DatosFacturacion->DatosFacturacionKey  = $row->t03_pk01;  
          $DatosFacturacion->RazonSocial          = $row->t03_f001;  
          $DatosFacturacion->Tipo                 = $row->t03_f002;  
          $DatosFacturacion->RFC                  = $row->t03_f003;  
          $DatosFacturacion->Calle                = $row->t03_f004;  
          $DatosFacturacion->NumeroExterior       = $row->t03_f005;  
          $DatosFacturacion->NumeroInterior       = $row->t03_f006;  
          $DatosFacturacion->CodigoPostal         = $row->t03_f007;  
          $DatosFacturacion->Estado               = $row->t03_f008;  
          $DatosFacturacion->Municipio            = $row->t03_f009;  
          $DatosFacturacion->Colonia              = $row->t03_f010;  
          $DatosFacturacion->Activo               = $row->t03_f011;
          $data[] = $DatosFacturacion;
        }
        unset($DatosFacturacion);  
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
        $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosFacturacion(
          ".$this->DatosFacturacionKey.",
          '".$this->RazonSocial."',
          '".$this->Tipo."',
          ".$this->RFC.",
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