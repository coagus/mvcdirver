<?php
require_once __DIR__ . '/../lib/vcl/controller.php';
require_once __DIR__ . '/../mdl/seleccion.php';
require_once __DIR__ . '/../lib/utl/catalogos.php';

class SeleccionController extends Controller {
    private $catalogo;
    
    public function __CONSTRUCT($action = 'index') {
        parent::__construct('seleccion', $action);
        $this->object = new Seleccion();
        $this->catalogo = new Catalogo();
    }
    
    public function getGenero($codigo) {
        return array_search($codigo, $this->catalogo->genero);
    }
    
    public function getListGenero() {
        return $this->catalogo->genero;
    }
    
    public function abc() {
        if (isset($_REQUEST['IdEdit']))
            $this->object = $this->object->getById($_REQUEST['IdEdit']);
            
        $this->view();
    }
    
    public function guardar() {
        $selec = new Seleccion();
        $selec->Id = $_REQUEST['Id'];
        $selec->Mundial = $_REQUEST['Mundial'];
        $selec->Edad = $_REQUEST['Edad'];
        $selec->Rango = $_REQUEST['Rango'];
        $selec->Genero = $_REQUEST['Genero'];
        
        $codigo = "S".substr($selec->Edad,-2);
        $codigo .= $selec->Genero == "1" ? "M" : "F";
        $codigo .= substr($selec->Mundial,-2);
        $codigo .= substr($selec->Mundial-$selec->Edad,-2);
        $codigo .= substr($selec->Mundial-$selec->Edad+$selec->Rango,-2);
        
        $selec->Codigo = $codigo;
        $selec->save();
        
        $this->view("index");
    }
}
?>