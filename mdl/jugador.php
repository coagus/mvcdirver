<?php
require_once __DIR__ . '/../lib/mvc/table.php';

class Jugador extends Table {
    public $Id = '';
    public $Codigo = '';
    public $Nombre1 = '';
    public $Nombre2 = '';
    public $Apellido1 = '';
    public $Apellido2 = '';
    public $Genero = '';
    public $Cui = '';
    public $Correo = '';
    public $Fechanac = '';
    public $Deptonac = '';
    public $Muninac = '';
    public $Tiposangre = '';
    public $Escolaridad = '';
    public $Alergias = '';
    public $Nombrepadre = '';
    public $Nombremadre = '';
    public $Teljugador = '';
    public $Telpadre = '';
    public $Telmadre = '';
    public $Pasaporte = '';
    public $Pasaporteven = '';
    public $Visa = '';
    public $Visaven = '';
    public $Visamex = '';
    public $Visamexven = '';
    public $Nit = '';
    public $Posiciones = '';
    public $Activo = '';
    public $Foto = '';
    public $Fotocompleta = '';
    
    public function __CONSTRUCT() {
        parent::__construct('Jugador');
    }
    
    public function save() {
        $this->saveData($this->Id, get_object_vars($this));
    }
    
    public function getWhere() {
        return $this->getRowsWhere(get_object_vars($this));
    }
}
?>
