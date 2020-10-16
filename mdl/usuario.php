<?php
require_once __DIR__ . '/../lib/mvc/table.php';

class Usuario extends Table {
    public $Id = '';
    public $Usuario = '';
    public $Nombre = '';
    public $Password = '';
    
    public function __CONSTRUCT() {
        parent::__construct('Usuario');
    }
    
    public function save() {
        $this->saveData($this->Id, get_object_vars($this));
    }
    
    public function getWhere() {
        return $this->getRowsWhere(get_object_vars($this));
    }
}
?>
