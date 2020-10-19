<?php
require_once __DIR__ . '/../lib/mvc/controller.php';
require_once __DIR__ . '/../mdl/usuario.php';

class HomeController extends Controller {
    private $error = '';
    
    public function __CONSTRUCT($action = 'index') {
        parent::__construct('home', $action);
    }
    
    public function login() {
        $this->view();
    }
    
    public function setLogin() {
        $view = 'login';
        
        if (isset($_REQUEST['Usuario']) && $_REQUEST['Usuario']!="" && $_REQUEST['Password']!="") {
            $usr         = $_REQUEST['Usuario'];
            $pwd         = isset($_REQUEST['Password']) ? $_REQUEST['Password'] : '';
            $this->error = "usuario: $usr / pass: $pwd <br>";
            
            if ($this->validaUsuario($usr, $pwd)) {
                $view = 'index';
            } else {
                $this->error = 'Usuario incorrecto.';
            }
        } else {
            $this->error = 'No ingreso alguno de los datos';
        }
        
        $this->view($view);
    }
    
    public function validaUsuario($usr, $pwd) {
        if (trim($usr) == '' || trim($pwd) == '')
            return false;
        
        $usuario           = new Usuario();
        $usuario->Usuario  = $usr;
        $usuario->Password = $pwd;
        $usr               = $usuario->getWhere();
        $valido            = count($usr) == 1;
        
        if ($valido) {
            $_SESSION["Id"]      = $usr[0]->Id;
            $_SESSION["Usuario"] = $usr[0]->Usuario;
        }
        
        return $valido;
    }
    
    public function logout() {
        session_destroy();
        $this->view('login');
    }
    
    public function getError() {
        return $this->error;
    }
}
?>
