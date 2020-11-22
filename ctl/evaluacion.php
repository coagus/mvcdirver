<?php
require_once __DIR__ . '/../lib/vcl/controller.php';
require_once __DIR__ . '/../lib/utl/catalogos.php';

class EvaluacionController extends Controller {
    private $catalogo;
    
    public function __CONSTRUCT($action = 'index') {
        parent::__construct('evaluacion', $action);
        $this->catalogo = new Catalogo();
    }
    
}
?>