<?php 

  /**
   * 
  */
  @session_start();
  if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Tools/Functions_tools.php';
  }if (!class_exists("Email")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/Email/Email.php';
  }

  class EmailTest{
    
    public function __construct(){
      $this->Tool = new Functions_tools();
    }
    /**
     * Hacer pago compra
     *
     * @return int $b Bar
    */
    public function test(){
      $Email = new Email();
      $Email->MailerSubject = "Ecommerce";
      $Email->MailerBody = $this->Tool->GetTemplate('http://'.$_SERVER['HTTP_HOST'].'/Fibremex/b2b/views/Templates/Email/Pedido.php?CotizacionKey='.$_SESSION['id_cotizacion']);
      $Email->MailerListTo = ['jesus.herrera@splittel.com'];
      $Email->EmailSendEmail();
    }

    public function controller(){
      $EmailTest = new EmailTest();
      $Action = $EmailTest->Tool->validate_isset_post("Action");
      switch ($Action) {
        case 'test':
          echo $EmailTest->test();
          break;
        default:
          echo $EmailTest->Tool->Message_return(true, "No se encontro la opción solicitada, por favor pide ayuda al departamento de TI...", null, true);
          break;
      }
    }

  }

  EmailTest::controller();