<?php 

  /**
   * 
   */
  @session_start();
  if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Tools/Functions_tools.php';
  }if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/models/Tools/Connection.php';
  }if (!class_exists("File")) {
    include $_SERVER["DOCUMENT_ROOT"].'/models/File/File.Model.php';
  }

  class FileController{
    protected $conn;
    protected $Tool;

    public $filter;
    public $order;
    
    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }
    /**
     * Obtención 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function get($return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $FileModel = new File(); 
          $FileModel->SetParameters($this->conn, $this->Tool);
          $items = $FileModel->Get($this->filter, $this->order);
          unset($FileModel);
          return $this->Tool->Message_return(false, "", $items, $return_json);
        }
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
    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post('Action');
        switch ($Action) {
          case 'create':
            
            break;
          default:
            throw new Exception("No se pudo encontrar la opción solicitada, por favor contactanos");
            break;
        }
      } catch (Exception $e) {
        echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }
  }

  $Tool = new Functions_tools();
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && $_POST['ActionFile']) {
    $FileController = new FileController();
    $FileController->controller();
    unset($FileController);
  }
  unset($Tool);