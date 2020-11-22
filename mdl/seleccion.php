<?php
require_once __DIR__ . '/../lib/mvc/table.php';

class Seleccion extends Table {
    public $Id = '';
    public $Codigo = '';
    public $Edad = '';
    public $Mundial = '';
    public $Rango = '';
    public $Genero = '';
    
    public function __CONSTRUCT() {
        parent::__construct('Seleccion');
    }
    
    public function save() {
        $this->saveData($this->Id, get_object_vars($this));
    }
    
    public function getWhere() {
        return $this->getRowsWhere(get_object_vars($this));
    }
}
?>
