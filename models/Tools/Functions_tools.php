<?php
@session_start();
@header('Content-Type: charset=utf-8');
date_default_timezone_set('America/Mexico_City');
class Functions_tools
{
    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function EncrypDatHash($data){
        $key = "GruP0-Split3L";
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $data, MCRYPT_MODE_CBC, md5(md5($key))));
    }
    /**
     * Undocumented function
     *
     * @param [type] $encoded
     * @return void
     */
    public function DecrypDatHash($encoded){
        $key = "GruP0-Split3L";
        $encoded = str_replace(" ","+",$encoded);
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encoded), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }
    /**
     * Undocumented function
     *
     * @param [type] $url
     * @return void
     */
    public function GetTemplate($url){
        try{
            $c = curl_init($url);    // initialize curl handle
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			
            $html = curl_exec($c);
            
            if (curl_error($c))
                die(curl_error($c));
            
            // Get the status code
            $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
            // echo $html;
            curl_close($c);
            return $html;
        }catch (Exception $e) {
            throw $e;
        }

    }
    function GetTemplatePost($url,$params)
    {
        $postData = '';
        //create name value pairs seperated by &
        foreach($params as $k => $v) 
        { 
            $postData .= $k . '='.$v.'&'; 
        }
        $postData = rtrim($postData, '&');
    
        $ch = curl_init();  
    
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
    
        $output=curl_exec($ch);
    
        curl_close($ch);
        return $output;
    
    }
    /**
     * funcion para validar fechas
     *
     * @param [type] $date1
     * @param [type] $date2
     * @return boolean
     */
    public function isValidRangeHours($hour1, $hour2){
        $newHour = strtotime( date('H:i'));
        $hour1 = strtotime( date($date1));
        $hour2 = strtotime( date($date2));
        if($hour1 < $newHour){
            throw new Exception("El campo <strong></strong> debe de ser mayor a la fecha del día de hoy ");
        }
        if($hour2 < $newHour){
            throw new Exception("El campo <strong></strong> debe de ser mayor a la fecha del día de hoy ");
        }
        if($hour1 == $hour2){
            throw new Exception("El campo <strong></strong> es igual que El campo <strong></strong> ");
        }else if($hour1 >  $hour2){
            throw new Exception("El campo <strong></strong> es mayor que El campo <strong></strong> ");
        }
    }
    /**
     * funcion para validar fecha y tiempo(datatime)
     *
     * @param [type] $date1
     * @param [type] $date2
     * @return boolean
     */
    public function isValidRangeDates($date1, $date2){
        $newDate = strtotime( date('d-m-Y H:i:s'));
        $datetime1 = strtotime( date($date1['value']));
        $datetime2 = strtotime( date($date2['value']));
        if($datetime1 < $newDate){
            throw new Exception("El campo <strong>".$date1['label']."</strong> debe de ser mayor a la fecha del día de hoy");
        }
        if($datetime2 < $newDate){
            throw new Exception("El campo <strong>".$date2['label']."</strong> debe de ser mayor a la fecha del día de hoy");
        }
        if($datetime2 < $newDate){
            throw new Exception("El campo <strong>".$date1['label']."</strong> es igual que El campo <strong>".$date2['label']."</strong> ");
        }
        if($datetime1 == $datetime2){
            throw new Exception("El campo <strong>".$date1['label']."</strong> es igual que El campo <strong>".$date2['label']."</strong> ");
        }else if($datetime1 >  $datetime2){
            throw new Exception("El campo <strong>".$date1['label']."</strong> es mayor que El campo <strong>".$date2['label']."</strong> ");
        }
    }
    public function  activeSession(){
        if(isset($_SESSION['USER_ID'])){
            return true;
        }else{
            throw new Exception("Por favor inicia sesión");
        }
    }
    public function validate_isset_post($name){
        return isset($_POST[$name]) && $_POST[$name] != null ? $_POST[$name] : "";
    }
    public function Message_return($error,$message,$records,$return_json){
        $object          = new stdClass();
        $object->error   = $records == null ? $error : count($records) == 0 ? true: false;
        $object->message = $this->validate_array($records, $message);
        $object->records = $records;
        $object->count  = $records == null ? 0 : count($records);
        return $return_json == true ? json_encode($object, JSON_UNESCAPED_UNICODE) : $object;
    }
    public function validate_array($records,$message){
        $message_r = "";
        if($records == null){
            if($message == null){
                $message_r = "No existen datos para mostrar";
            }else{
                $message_r = $message;
            }
        }else{
            if($message == null){
                $message_r = "Datos obtenidos exitosamente";
            }else{
                $message_r = $message;
            }
        }
        return $message_r;
    }
    public function Clear_data_for_sql($data){
        $data = str_replace("'","''",$data);

        return $data;
    }
    public function validDataString($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (is_string($data)) {
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
            }
        }
    }
    public function validEmail($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
            }
        }
    }
    public function validCurp($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
            }
        }
    }
    public function validPhoneNumber($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided){
            if($data == ""){
                throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
            }else{
                if (preg_match ("/^[0-9]{10}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido, debe de ser conformado por 10 digitos númericos'");
                }
            }
        }else{
            if($data != ""){
                if (preg_match ("/^[0-9]{10}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido, debe de ser conformado por 10 digitos númericos'");
                }
            }
        }
    }
    public function validRFC($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[A-Z][A,E,I,O,U][A-Z]{2}[0-9]{6}[A-Z,0-9]{3}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
            }
        }
    }
    public function validCodigoPostal($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided){
            if($data == ""){
                throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
            }else{
                if (preg_match ("/^[0-9]{5}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
                }
            }
        }else{
            if($data != ""){
                if (preg_match ("/^[0-9]{5}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
                }
            }
        }
    }
    public function validSchedule($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[A-Z]{3}\.[A-Z0-9]{2}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
            }
        }
    }
    public function validDate($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[A-Z]{3}\.[A-Z0-9]{2}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
            }
        }
    }
    public function validNumber($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (is_numeric($data) || $data == "") { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido'");
            }
        }
    }
    public function mes($index){
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        return $meses[$index];
    }
    public function Dias($index){
        $meses = array("Dom","Lun", "Mar", "Mier", "Jue", "Vie", "Sab");
        return $meses[$index];
    }
    /**
     * Creación nueva carpeta si es que no existe en la ruta asiganada
     *
     * @param string $directory
     *
     */
    public function createFolder($directory){
      if (!is_dir($directory)) {
        @mkdir($directory, 0007);
      }
    }

    /**
     * Autorización via ajax mediante usuario y contraseña desencriptados
     *
     * @return boolean
     */
    public function securityAjax(){
      if (!class_exists('EncrypData_')) {
        include $_SERVER['DOCUMENT_ROOT'].'/grupodly.com/models/Tools/EncrypData.php';
      }
        $EncrypData = new EncrypData_('productivo');

        if (isset($_SESSION['Ecommerce-ClienteKey'])) {
          if (!class_exists("ClienteController")) {
            include $_SERVER["DOCUMENT_ROOT"].'/grupodly.com/models/Cliente/Cliente.Controller.php';
          }
          $ClienteController = new ClienteController();
          $ClienteController->filter = "WHERE t01_pk01 = ".$_SESSION['Ecommerce-ClienteKey']." ";
          $ClienteController->order = "";
          $responseCliente = $ClienteController->get(false)->records[0];
          # Construcción de contraseña y usuario 
          $AdminLogin = $_SESSION['Ecommerce-ClienteEmail']; 
          $AdminPassword = $responseCliente->Password.'-'.$_SESSION['Ecommerce-ClienteKey'].'-'.$responseCliente->FechaRegistro; 
        }else{
          $AdminLogin = 'anonimo@grupodly.com'; 
          $AdminPassword = 'grupodlyEcommerce-anonimo-'.date('Y-m-d'); // Could be hashed too.
        }

        $PHP_AUTH_USER = $EncrypData->cadenaDecrypt($_SERVER['PHP_AUTH_USER']);
        $PHP_AUTH_PW = $EncrypData->cadenaDecrypt($_SERVER['PHP_AUTH_PW']);
        
        return ($PHP_AUTH_USER == $AdminLogin) || ($PHP_AUTH_PW == $AdminPassword) ? true : false;
    }
}