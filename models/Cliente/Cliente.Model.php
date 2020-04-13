<?php
class Cliente{
    public $ClienteKey;
    public $Nombre;
    public $Apellido;
    public $Correo;
    public $Telefono;
    public $Password;
    public $PasswordConfirm;
    public $Activo;
    public $FechaRegistro;

    protected $Connection;
    protected $Tool;
        
    public function SetParameters($conn, $Tool){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    public function SetClienteKey($ClienteKey){
        if(!is_numeric($ClienteKey)){
            throw new Exception('$ClienteKey debería de ser int');
        }
        $this->ClienteKey = $ClienteKey;
    }
    public function SetNombre($Nombre){
        if(!is_string($Nombre) || is_null($Nombre)){
            throw new Exception('$Nombre debería de ser string');
        }
        $this->Nombre = $Nombre;
    }public function SetApellido($Apellido){
        if(!is_string($Apellido) || is_null($Apellido)){
            throw new Exception('$Apellido debería de ser string');
        }
        $this->Apellido = $Apellido;
    }public function SetCorreo($Correo){
        if(!is_string($Correo) || is_null($Correo)){
            throw new Exception('$Correo debería de ser string');
        }
        $this->Correo = $Correo;
    }public function SetTelefono($Telefono){
        if(!is_string($Telefono) || is_null($Telefono)){
            throw new Exception('$Telefono debería de ser string');
        }
        $this->Telefono = $Telefono;
    }public function SetPassword($Password){
        if(!is_string($Password) || is_null($Password)){
            throw new Exception('$Password debería de ser string');
        }
        $this->Password = $Password;
    }public function SetPasswordConfirm($PasswordConfirm){
        if(!is_string($PasswordConfirm) || is_null($PasswordConfirm)){
            throw new Exception('$PasswordConfirm debería de ser string');
        }
        $this->PasswordConfirm = $PasswordConfirm;
    }

    public function Get($filter, $order){
        try {
            $SQLSTATEMENT = "SELECT * FROM t01_cliente ".$filter." ".$order;
            // echo $SQLSTATEMENT;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT);
            $data = [];

            while ($row = $result->fetch_object()) {
              $Cliente = new Cliente();
              $Cliente->ClienteKey      = $row->t01_pk01;
              $Cliente->Nombre          = $row->t01_f001;
              $Cliente->Apellido        = $row->t01_f002;
              $Cliente->Correo          = $row->t01_f006;
              $Cliente->Telefono        = $row->t01_f003;
              $Cliente->Password        = $row->t01_f004;
              $Cliente->Activo          = $row->t01_f005;
              $Cliente->FechaRegistro   = $row->t01_f098;
              $data[] = $Cliente;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
   * Creación registro cliente
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function create(){
    try{
      $result = array();
      $result = $this->Connection->Exec_store_procedure_json("CALL ClienteRegistro(
          ".$this->ClienteKey.",
          '".$this->Nombre."',
          '".$this->Apellido."',
          '".$this->Telefono."',
          '".$this->Password."',
          '".$this->PasswordConfirm."',
          '".$this->Correo."',
          @Result);","@Result");
      return $result; 
    }catch (Exception $e) {
      throw $e;
    }
  }

}

?>