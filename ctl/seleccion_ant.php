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
    
    public function getTipo($codigo) {
        return array_search($codigo, $this->catalogo->tiposeleccion);
    }
    
    public function getCodigo($codigo) {
        return array_search($codigo, $this->catalogo->codigoseleccion);
    }
    
    public function getListTipo() {
        return $this->catalogo->tiposeleccion;
    }
    
    public function getMayor($mundial, $tipo) {
        return intval($mundial) - intval(substr($this->getCodigo($tipo),1));
    }
    
    public function getMenor($mundial, $tipo) {
        return intval($mundial) - intval(substr($this->getCodigo($tipo),1)) + 2;
    }
    
    public function getSeleccion($tipo, $mundial) {
        $seleccion = $this->getCodigo($tipo);
        $seleccion .= substr($mundial, -2);
        $seleccion .= str_pad(substr(strval($this->getMayor($mundial, $tipo)),-2), 2, "0", STR_PAD_LEFT);
        $seleccion .= str_pad(substr(strval($this->getMenor($mundial, $tipo)),-2), 2, "0", STR_PAD_LEFT);
        return $seleccion;
    }
    
    public function getSelecciones() {
        $selecciones = [];
        $s = new Seleccion();
        $s->Mundial = isset($_REQUEST['Mundial']) ? $_REQUEST['Mundial'] : date('Y')+1;
        $creadas = $s->getWhere();
        
        foreach($this->getListTipo() as $key => $tipo) {
            $creada = 0;
            foreach ($creadas as $c) {
                if ($c->Mundial == $s->Mundial && $c->Tipo == $tipo) {
                    $creada = 1;
                    break;
                }
            }
            $selecciones[] = array($this->getSeleccion($tipo, $s->Mundial), $this->getTipo($tipo), $this->getMayor($s->Mundial, $tipo), $this->getMenor($s->Mundial,$tipo), $creada, $s->Mundial, $tipo);
        }
        
        return $selecciones;
    }
    
    public function selecciones() {
        $this->view('selecciones');
    }
    
    public function crear() {
        $seleccion = new Seleccion();
        $seleccion->Tipo = $_REQUEST['Tipo'];
        $seleccion->Mundial = $_REQUEST['Mundial'];
        $seleccion->Seleccion = $this->getSeleccion($seleccion->Tipo, $seleccion->Mundial);
        $seleccion->save();
        
        $this->view("selecciones");
    }
}
?>