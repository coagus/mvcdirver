<?php
require_once __DIR__ . '/../lib/vcl/controller.php';
require_once __DIR__ . '/../mdl/usuario.php';
require_once __DIR__ . '/../lib/utl/catalogos.php';

class UsuarioController extends Controller {
    private $catalogo;
    private $guardoperfil;
    
    public function __CONSTRUCT($action = 'index') {
        parent::__construct('usuario', $action);
        $this->object = new Usuario();
        $this->catalogo = new Catalogo();
        $this->guardoperfil = 0;
    }
    
    public function getTipo($codigo) {
        return array_search($codigo, $this->catalogo->tipousuario);
    }
    
    public function getListTipo() {
        return $this->catalogo->tipousuario;
    }
    
    public function abc() {
        if (isset($_REQUEST['IdEdit']))
            $this->object = $this->object->getById($_REQUEST['IdEdit']);
            
        $this->view();
    }
    
    public function guardoPerfil() {
        return $this->guardoperfil == 1;
    }
    
    public function guardar() {
        $usuario = new Usuario();
        $usuario->Id = $_REQUEST['Id'];
        $usuario->Usuario = $_REQUEST['Usuario'];
        $usuario->Nombre = $_REQUEST['Nombre'];
        $usuario->Password = $_REQUEST['Password'];
        $usuario->Tipo = $_REQUEST['Tipo'];
        $usuario->save();
        
        if ($usuario->Id == $_SESSION["Id"]) {
            $this->guardoperfil = 1;
            $this->object = $this->object->getById($_REQUEST['Id']);
            $this->view("abc");
        } else {
            $this->view("index");
        }
    }
}
?>