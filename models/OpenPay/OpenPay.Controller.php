<?php
    @session_start();
    if (!class_exists('Connection')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Connection.php';
    }if (!class_exists('Functions_tools')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
    }if (!class_exists('Pedido')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Pedido/Pedido.Model.php';
    }if (!class_exists("ClienteController")) {
      include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Cliente/Cliente.Controller.php';
    }if (!class_exists('OpenPay_')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/OpenPay/OpenPay.Model.php';
    }
    class OpenPayController{
        private $Connection;
        private $Tool;
        private $PedidoModel;
        private $ClienteModel;
        private $OpenPay_;

        public function __construct(){
            $this->Connection = new Connection();
            $this->Tool = new Functions_tools();
            $this->PedidoModel =  new Pedido();
            $this->ClienteController = new ClienteController();
            $this->OpenPay_ =  new OpenPay_();

        }
        public function SetParameters($conn,$Tool){
            $this->Connection = $conn;
            $this->Tool = $Tool;
        }
        public function Create($source_id, $device_session_id,$pedidoID,$UserID){
            try {
                if (!$this->Connection->conexion()->connect_error) {
                    $this->PedidoModel->SetParameters($this->Connection, $this->Tool);
                    $this->OpenPay_->SetId("m1sgywxddqxx4mzfnzkk");
                    $this->OpenPay_->SetPublicKey("sk_9c856f92cb03439d9939220d9838226a");
                    $this->OpenPay_->SetTokenId($source_id);
                    $this->OpenPay_->SetDeviceSessionId($device_session_id);
                    $this->OpenPay_->SetProductionMode(false);
                    
                    $this->ClienteController->filter = "where t01_pk01 = '".$UserID."'";
                    $this->ClienteController->order = "";
                    $ClienteModel = $this->ClienteController->get(false)->records[0];
                    $pedido = $this->PedidoModel->GetBy($pedidoID,"");
                    $Result = $this->OpenPay_->CreateCharge($ClienteModel,$this->PedidoModel,"MXN");
                    if($Result->status == "completed"){
                        $this->PedidoModel->SetReferenciaOpenPay($Result->id);
                        $this->PedidoModel->SetDatosEnvio(1);
                        $this->PedidoModel->SetDatosFacturacion(1);
                        $this->PedidoModel->SetKey($pedidoID);
                        $resultStre = $this->PedidoModel->UpdateReferencePago();
                        return $this->Tool->Message_return(false, "Pago exitoso!!", null, false);
                    }else{
                        throw new Exception("No se pudo realizar el pago, verifica que tus datos sean correctos", 1);
                    }
                }else{
                    throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos", 1);
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
        

    }

?>