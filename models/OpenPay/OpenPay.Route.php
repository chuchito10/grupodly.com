<?php
    @session_start();
    if (!class_exists('Functions_tools')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/Functions_tools.php';
    }if (!class_exists('OpenPayController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/OpenPay/OpenPay.Controller.php';
    }
    class OpenPayRoute{
        private $Tool;

        public function __construct(){
            $this->Tool = new Functions_tools();
        }
        public function Controller(){
            try {
                $Action = $this->Tool->validate_isset_post('Action');
                switch ($Action) {
                    case 'Create':
                        $OpenPayController = new OpenPayController();
                        $Result = $OpenPayController->Create($_POST['tokenId'],$_POST['deviceSessionId'],$_SESSION['Ecommerce-PedidoKey'],$_SESSION['Ecommerce-ClienteKey']);
                        if($Result->error ==  false) {
                            $_SESSION['Ecommerce-PedidoTotal'] = 0;
                            unset($_SESSION['Ecommerce-PedidoKey']);
                        }
                        echo json_encode($Result);
                    break;
                    default:
                        throw new Exception("No se encontro la opción solicitada, por favor contactanos");
                    break;
                }
            } catch (Exception $e) {
                echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
            }
        }
    }
    $Tool = new Functions_tools();
    # Comprobación Autorización Ajax    
    if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_POST['ActionOpenPay'])) { 
        $DetalleController = new OpenPayRoute();
        $DetalleController->Controller();
        unset($DetalleController);
    }
    unset($Tool);

?>