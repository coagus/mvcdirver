<?php
class Catalogo {
    public $tiposangre = [
        '-' => '0',
        'O+' => '1',
        'O-' => '2',
        'A+' => '3',
        'A-' => '4',
        'B+' => '5',
        'B-' => '6',
        'AB+' => '7',
        'AB+' => '8'
        ];
    
    public $escolaridad = [
        'Elige una escolaridad' => '0',
        'Primaria' => '1',
        'Secundaria' => '2',
        'Diversificado' => '3',
        'Universitaria' => '4'
        ];
    
    public $genero = [
        'Masculino' => '1',
        'Femenino' => '2'
        ];
    
    public $tipousuario = [
        'Administrador' => '1',
        'Jugador' => '2',
        'Entrenador' => '3',
        'Cuerpo Técnico' => '4'
        ];
        
    public $tiposeleccion = [
        'Sub-20' => '1',
        'Sub-17' => '2',
        'Sub-15' => '3'
        ];
    
    public $codigoseleccion = [
        'S20' => '1',
        'S17' => '2',
        'S15' => '3'
        ];
}

?>