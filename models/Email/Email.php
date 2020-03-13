<?php 
    include $_SERVER["DOCUMENT_ROOT"].'/models/Librerias/PHPMailer/class.phpmailer.php';
    include $_SERVER["DOCUMENT_ROOT"].'/models/Librerias/PHPMailer/class.smtp.php';
    include $_SERVER["DOCUMENT_ROOT"].'/models/Tools/Functions_tools.php';
    @session_start();
    @header('Content-Type: charset=utf-8');
    class Email{
        public $Mailer;
        public $MailerSubject;
        public $MailerListTo;
        public $MailerListCC;
        public $MailerListBCC;
        public $MailerBody;
        public $MailerIsHTML;

        public function __construct(){
          try{
            $this->Mailer         = new PHPMailer();
            $this->Mailer->IsSMTP();
            $this->Mailer->SMTPAutoTLS  =   false;
            // $this->Mailer->SMTPAuth     =  true;
            $this->Mailer->SMTPAuth     =   false; #prueba
            $this->Mailer->SMTPSecure   =   false;
            
            /* $this->Mailer->Host      =   '68.71.58.18';
            $this->Mailer->Port      =   '587';*/
            
            // // TEST
            $this->Mailer->Host       =   '192.168.31.31';
            $this->Mailer->Port       =   '26';
            
            $this->Mailer->Username       =  'notificaciones@fibremex.com';
            $this->Mailer->Password       =  'notificaciones.2017';

            $this->Mailer->isHTML(true);
            $this->Mailer->CharSet = 'UTF-8';
            $this->Mailer->Encoding = 'base64';
          }catch (Exception $e) {
            throw $e;
          }
        }
        /**
         * Undocumented function
         *
         * @return void
         */
        public function EmailSendEmail(){
          try{
            $this->EmailAddListTo();
            $this->EmailAddListCC();
            $this->EmailAddListBCC();
            $this->EmailAddBCCSistemas();
            $this->Mailer->Subject = "=?ISO-8859-1?B?".base64_encode($this->MailerSubject)."=?=";
            $this->Mailer->Body = $this->MailerBody;
            if ($this->Mailer->Send()) { 
              return true;
            }else{
              return false;
            }
          }catch (Exception $e) {
            throw $e;
          }
        }
        /**
         * Undocumented function
         *
         * @return void
         */
        public function EmailAddListTo(){
          if($this->MailerListTo != null){
            foreach($this->MailerListTo as $email) { 
              if($email!=null){
                $this->Mailer->AddAddress($email);
              }      
            }
          }
        }
        /**
         * Undocumented function
         *
         * @return void
         */
        public function EmailAddListCC(){
          if($this->MailerListCC != null){
            foreach($this->MailerListCC as $email) { 
              if($email!=null){
                $this->Mailer->AddCC($email);
              }      
            }
          }
        }
        /**
         * Undocumented function
         *
         * @return void
         */
        public function EmailAddListBCC(){
          if($this->MailerListBCC != null){
            foreach($this->MailerListBCC as $email) { 
              if($email!=null){
                $this->Mailer->AddBCC($email);
              }      
            }
          }
        }
        public function EmailAddBCCSistemas(){
          $this->Mailer->AddBCC("jesus.herrera@splittel.com");
          $this->Mailer->AddBCC("luis.martinez@splittel.com");
        }

    }
?>