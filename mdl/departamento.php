<?php
require_once __DIR__ . '/../lib/mvc/table.php';

class Departamento extends Table {
    public $Id = '';
    public $Departamento = '';
    
    public function __CONSTRUCT() {
        parent::__construct('Departamento');
    }
    
    public function getWhere() {
        return $this->getRowsWhere(get_object_vars($this));
    }
}
?>