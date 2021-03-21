<?php
require_once __DIR__ . '/../lib/mvc/table.php';
// Catálogos
require_once __DIR__ . '/../mdl/rol.php';

class Usuario extends Table {
    public $Id = '';
    public $Nombre = '';
    public $Usuario = '';
    public $Password = '';
    public $Rol = '';
    
    public function __CONSTRUCT() {
        parent::__construct('Usuario');
    }
    
    // Control
    public function save() {
        return $this->saveData($this->Id, get_object_vars($this));
    }
    
    public function getWhere() {
        return $this->getRowsWhere(get_object_vars($this));
    }
    
    // Visualización al listar
    public function showField($name) {
        $show = array("Usuario", "Rol");
        return in_array($name, $show);
    }
    
    public function hideField($name) {
        $hide = array("Id", "Password");
        return in_array($name, $hide);
    }
    
    public function hideFieldView($key) {
        $hide = array("Id", "Password");
        return in_array($key, $hide);
    }
    
    // Catálogos
    public function hasCatalogo($key) {
        return $key == 'Rol';
    }
    
    public function getValCatalogo($key,$val) {
        if ($key == 'Rol') {
            $rol = new Rol();
            $val = $rol->getById($val)->Rol;
        }
        return $val;
    }
    
    public function getCatalogo($key) {
        $catalogo = [];
        if ($key == 'Rol') {
            $rol = new Rol();
            foreach ($rol->getList() as $r) {
                $catalogo[] = array($r->Id, $r->Rol);
            }
        }
        return $catalogo;
    }
}
?>
