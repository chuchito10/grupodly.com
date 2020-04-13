<?php
    include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Librerias/OpenPay/Openpay.php';
    class OpenPay_{
        protected $OpenPayy;
        protected $TokenId;
        protected $DeviceSessionId;
        protected $Id;
        protected $PublicKey;
        protected $PrivateKey;
        protected $Url;
        protected $ProductionMode;
        protected $Connection;
        protected $Tool;

        public function __construct(){
      
        }
        
        public function SetParameters($conn, $Tool){
            $this->Connection = $conn;
            $this->Tool = $Tool;
        }
        public function GetId(){
            return $this->Id;
        }
        public function GetPublicKey(){
            return $this->PublicKey;
        }
        public function GetPrivateKey(){
            return $this->PrivateKey;
        }
        public function GetUrl(){
            return $this->Url;
        }
        public function GetProductionMode(){
            return $this->ProductionMode;
        }
        public function SetTokenId($TokenId){
            $this->TokenId = $TokenId;
        }
        public function SetDeviceSessionId($DeviceSessionId){
            $this->DeviceSessionId = $DeviceSessionId;
        }
        public function SetId($Id){
            // if(!is_numeric($Id)){
            //     throw new Exception('$Id debería de ser int');
            // }
            $this->Id = $Id;
        }
        public function SetPublicKey($PublicKey){
            // if(!is_numeric($PublicKey)){
            //     throw new Exception('$PublicKey debería de ser int');
            // }
            $this->PublicKey = $PublicKey;
        }
        public function SetPrivateKey($PrivateKey){
            if(!is_numeric($PrivateKey)){
                throw new Exception('$PrivateKey debería de ser int');
            }
            $this->PrivateKey = $PrivateKey;
        }
        public function SetUrl($Url){
            if(!is_numeric($Url)){
                throw new Exception('$Url debería de ser int');
            }
            $this->Url = $Url;
        }
        public function SetProductionMode($ProductionMode){
            if(is_null($ProductionMode)){
                throw new Exception('$ProductionMode debería de diferente de null');
            }
            $this->ProductionMode = $ProductionMode;
        }
        protected function StartObjects(){
            $this->conn = new Connection();
            $this->Tool = new Functions_tools();
        }
        public function GetkeyById($id){
            try {
                $SQLSTATEMENT = "SELECT * FROM t10_keys_librerias WHERE t10_pk01 = '$id'";
                $result = $this->Connection->QueryReturn($SQLSTATEMENT);
                $fila = mysql_fetch_row($resultado);
                return $fila[2];
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function CreateCharge($Cliente,$PedidoCliente,$Moneda){
            if(is_null($this->Id)){
                throw new Exception('$Id is null');
            }
            if(is_null($this->PublicKey)){
                throw new Exception('$PublicKey is null');
            }
            try {
                $this->OpenPayy = Openpay::getInstance($this->Id, $this->PublicKey);
                Openpay::setProductionMode(false);
                $customer = array(
                    'name'          => $Cliente->Nombre,
                    'last_name'     => $Cliente->Apellido,
                    'phone_number'  => $Cliente->Telefono,
                    'email'         => $Cliente->Correo
                  );

                $valor= round($PedidoCliente->GetTotal(),2);
                $valor_s = strval($valor);
          
                  $chargeData = array(
                    'method' => 'card',
                    'source_id'         => $this->TokenId,//token targeta
                    'amount'            => $valor_s,
                    "currency"          => $Moneda,
                    'description'       => (float)$PedidoCliente->GetKey(),
                    'device_session_id' => $this->DeviceSessionId,// sessionDev []
                    'customer'          => $customer
                  );
                  $this->Charge = $this->OpenPayy->charges->create($chargeData);
                  return $this->Charge;
            } catch (Exception $e) {
                print_r($e);
                throw $e;
            }
        }
    }


?>