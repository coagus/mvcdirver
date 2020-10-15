<?php
class Controller {
    protected $object = null;
    protected $objectList = null;
    protected $title;
    private $controller;
    private $action;
    private $isCRUD = false;

    public function __CONSTRUCT($controller, $action) {
        $this->controller = $controller;
        $this->action = $action;
        
        if (!file_exists(__DIR__ . "/../../vie/$this->controller/$this->action.phtml")
                && (file_exists(__DIR__ . "/$this->action.phtml") || $this->action == "delete")) {
            $pathObject = __DIR__ . "/../../mdl/$this->controller.php";
                    
            if (file_exists($pathObject)) {
                require_once $pathObject;
                $table = ucwords($this->controller);
                $this->object = new $table();
                $this->title = $table;
                $this->isCRUD = true;
            } else {
                echo "No existe mantenimiento de ".ucwords($this->controller)." ($pathObject) ni vista $view a presentar";
                return;
            }
        }
    }
    
    protected function view($view = '') {
        $view = $view == '' ? $this->action : $view;
        $pathview  = __DIR__ . "/../../vie/$this->controller/$view.phtml";
        
        if (file_exists($pathview)) {
            require_once $pathview;
        } else {
            if ($this->isCRUD) {
                if ($view == "index")
                    $this->objectList = $this->object->getList();
                    
                require_once __DIR__ . "/$view.phtml";
            } else {
                echo "No se encuentra la vista $view";
            }
        }
    }
    
    public function index() {
        $this->view();
    }
    
    public function edit() {
        $view = '';
        
        if (isset($_REQUEST['Id'])) {
            foreach ($this->object as $key => $value) {
                if ($key == 'Id') {
                    $this->object->Id = $_REQUEST['Id'] == "0" ? '' : $_REQUEST['Id'];
                } else {
                    $this->object->$key = $_REQUEST[$key];
                }
            }
            
            $this->object->save();
            $this->objectList = $this->object->getList();
            $view = 'index';
        }
        
        if (isset($_REQUEST['IdEdit']))
            $this->object = $this->object->getById($_REQUEST['IdEdit']);

        $this->view($view);
    }
    
    public function delete() {
        if (isset($_REQUEST['Id']))
            $this->object->delete($_REQUEST['Id']);
            
        $this->view('index');
    }
    
    public function is_Date($str) {
        $str   = str_replace("/", "-", $str);
        $stamp = strtotime($str);
        
        if (strpos($str, "-") !== false && is_numeric($stamp)) {
            $month = date('m', $stamp);
            $day   = date('d', $stamp);
            $year  = date('Y', $stamp);
            
            return checkdate($month, $day, $year);
        }
        
        return false;
    }
}
?>