<?php
require_once __DIR__ . '/../lib/vcl/controller.php';

class FormularioController extends Controller {
    private $csv = [];
    
    public function __CONSTRUCT($action = 'index') {
        parent::__construct('formulario', $action);
    }

    public function resultform() {
        $this->view();
    }
    
    public function cargarcsv() {
        $this->view();
    }
    
    public function mostrarcsv() {
        $handle = fopen($_FILES['file']['tmp_name'], "r");
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $this->csv[] = array($data[0], $data[1], $data[2]);
        }
    
        fclose($handle);
        $this->view();
    }
    
    public function getCsv() {
        return $this->csv;
    }
}
?>