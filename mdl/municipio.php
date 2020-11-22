<?php
require_once __DIR__ . '/../lib/mvc/table.php';

class Municipio extends Table {
    public $Id = '';
    public $Municipio = '';
    public $Departamento_Id = '';
    
    public function __CONSTRUCT() {
        parent::__construct('Municipio');
    }
    
    public function getWhere() {
        return $this->getRowsWhere(get_object_vars($this));
    }
}
?>