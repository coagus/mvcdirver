<?php
require_once __DIR__ . '/../lib/mvc/controller.php';
require_once __DIR__ . '/../lib/utl/catalogos.php';
require_once __DIR__ . '/../mdl/jugador.php';
require_once __DIR__ . '/../mdl/usuario.php';
require_once __DIR__ . '/../mdl/departamento.php';
require_once __DIR__ . '/../mdl/municipio.php';

class JugadorController extends Controller {
    private $catalogo;
    private $fotoperfil;
    
    public function __CONSTRUCT($action = 'index') {
        parent::__construct('jugador', $action);
        $this->object = new Jugador();
        $this->catalogo = new Catalogo();
    }
    
    public function abcjugador() {
        if (isset($_REQUEST['IdEdit']))
            $this->object = $this->object->getById($_REQUEST['IdEdit']);
            
        $this->view();
    }
    
    public function perfil() {
        if (isset($_REQUEST['IdEdit']))
            $this->object = $this->object->getById($_REQUEST['IdEdit']);
            
        $this->view();
    }
    
    public function subirFotoPerfil() {
        $errors = array();
        $file_name = $_FILES['file_fotoperfil']['name'];
        $file_size = $_FILES['file_fotoperfil']['size'];
        $file_tmp = $_FILES['file_fotoperfil']['tmp_name'];
        $file_type = $_FILES['file_fotoperfil']['type'];
        $tmp = explode('.',$_FILES['file_fotoperfil']['name']);
        $file_ext = strtolower(end($tmp));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
        }
        
        
        
        if(empty($errors)==true){
            $this->fotoperfil = "img/fotopefil/".$_REQUEST['codigo'].".".$file_ext;
        
            $jugador = new Jugador();
            $jugador->Id = $_REQUEST['Id'];
            $jugador->Foto = $this->fotoperfil;
            $jugador->save();
        
            move_uploaded_file($file_tmp,__DIR__ ."/../".$this->fotoperfil);
        } else{
             print_r($errors);
        }
        
        $this->view();
    }
    
    public function subirFotoCompleta() {
        $errors = array();
        $file_name = $_FILES['file_fotocompleta']['name'];
        $file_size = $_FILES['file_fotocompleta']['size'];
        $file_tmp = $_FILES['file_fotocompleta']['tmp_name'];
        $file_type = $_FILES['file_fotocompleta']['type'];
        $tmp = explode('.',$_FILES['file_fotocompleta']['name']);
        $file_ext = strtolower(end($tmp));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true){
            $this->fotoperfil = "img/fotocompleta/".$_REQUEST['codigo'].".".$file_ext;
        
            $jugador = new Jugador();
            $jugador->Id = $_REQUEST['Id'];
            $jugador->Fotocompleta = $this->fotoperfil;
            $jugador->save();
        
            move_uploaded_file($file_tmp,__DIR__ ."/../".$this->fotoperfil);
        } else{
             print_r($errors);
        }
        
        $this->view();
    }
    
    public function getFotoperfil() {
        return $this->fotoperfil;
    }
    
    public function desactivar() {
        $this->object->Id = $_REQUEST['Id'];
        $this->object->Activo = "0";
        $this->object->save();
        $this->object = $this->object->getById($_REQUEST['Id']);
        $this->view("perfil");
    }
    
    public function activar() {
        $this->object->Id = $_REQUEST['Id'];
        $this->object->Activo = "1";
        $this->object->save();
        $this->object = $this->object->getById($_REQUEST['Id']);
        $this->view("perfil");
    }
    
    public function posiciones($edit = true) {
        if ($edit) {
            if (isset($_REQUEST['IdEdit'])) {
                $this->object = $this->object->getById($_REQUEST['IdEdit']);
            } else {
                $this->object = new Jugador();
                $pos = "";
                $pos .= isset($_REQUEST['A']) ? "A":"";
                $pos .= isset($_REQUEST['B']) ? "B":"";
                $pos .= isset($_REQUEST['C']) ? "C":"";
                $pos .= isset($_REQUEST['D']) ? "D":"";
                $pos .= isset($_REQUEST['E']) ? "E":"";
                $pos .= isset($_REQUEST['F']) ? "F":"";
                $pos .= isset($_REQUEST['G']) ? "G":"";
                $pos .= isset($_REQUEST['H']) ? "H":"";
                $pos .= isset($_REQUEST['I']) ? "I":"";
                $pos .= isset($_REQUEST['J']) ? "J":"";
                $pos .= isset($_REQUEST['K']) ? "K":"";
                $pos .= isset($_REQUEST['L']) ? "L":"";
                $pos .= isset($_REQUEST['M']) ? "M":"";
                $pos .= isset($_REQUEST['N']) ? "N":"";
                $pos .= isset($_REQUEST['O']) ? "O":"";
                $pos .= isset($_REQUEST['P']) ? "P":"";
                $pos .= isset($_REQUEST['Q']) ? "Q":"";
                $pos .= isset($_REQUEST['R']) ? "R":"";
                $pos .= isset($_REQUEST['S']) ? "S":"";
                $pos .= isset($_REQUEST['T']) ? "T":"";
                $pos .= isset($_REQUEST['U']) ? "U":"";
                $pos .= isset($_REQUEST['V']) ? "V":"";
                
                $this->object->Posiciones = $pos;
            }
        }
        
        $this->view('posiciones');
    }
    
    public function savePosition() {
        $pos = "";
        $pos .= isset($_REQUEST['A']) ? "A":"";
        $pos .= isset($_REQUEST['B']) ? "B":"";
        $pos .= isset($_REQUEST['C']) ? "C":"";
        $pos .= isset($_REQUEST['D']) ? "D":"";
        $pos .= isset($_REQUEST['E']) ? "E":"";
        $pos .= isset($_REQUEST['F']) ? "F":"";
        $pos .= isset($_REQUEST['G']) ? "G":"";
        $pos .= isset($_REQUEST['H']) ? "H":"";
        $pos .= isset($_REQUEST['I']) ? "I":"";
        $pos .= isset($_REQUEST['J']) ? "J":"";
        $pos .= isset($_REQUEST['K']) ? "K":"";
        $pos .= isset($_REQUEST['L']) ? "L":"";
        $pos .= isset($_REQUEST['M']) ? "M":"";
        $pos .= isset($_REQUEST['N']) ? "N":"";
        $pos .= isset($_REQUEST['O']) ? "O":"";
        $pos .= isset($_REQUEST['P']) ? "P":"";
        $pos .= isset($_REQUEST['Q']) ? "Q":"";
        $pos .= isset($_REQUEST['R']) ? "R":"";
        $pos .= isset($_REQUEST['S']) ? "S":"";
        $pos .= isset($_REQUEST['T']) ? "T":"";
        $pos .= isset($_REQUEST['U']) ? "U":"";
        $pos .= isset($_REQUEST['V']) ? "V":"";
        
        $this->object->Id = $_REQUEST['Id'];
        $this->object->Posiciones = $pos;
        $this->object->save();
        $this->view('posiciones');
    }
    
    public function getPosicion() {
        return $this->object->Posiciones;
    }
    
    public function getDeptos() {
        $deptos = new Departamento();
        return $deptos->getList();
    }
    
    public function getMunis($depto) {
        $munis = new Municipio();
        $munis->Departamento_Id = $depto;
        return $munis->getWhere();
    }
    
    public function setmuni() {
        $this->view();
    }
    
    public function getListTipoSangre() {
        return $this->catalogo->tiposangre;
    }
    
    public function getListEscolaridad() {
        return $this->catalogo->escolaridad;
    }
    
    public function getListGenero() {
        return $this->catalogo->genero;
    }
    
    public function getTipoSangre($codigo) {
        return array_search($codigo, $this->catalogo->tiposangre);
    }
    
    public function getEscolaridad($codigo) {
        return array_search($codigo, $this->catalogo->escolaridad);
    }
    
    public function getGenero($codigo) {
        return array_search($codigo, $this->catalogo->genero);
    }
    
    public function getDepto($codigo) {
        $deptos = new Departamento();
        return $deptos->getById($codigo)->Departamento;
    }
    
    public function getMuni($codigo) {
        $muni = new Municipio();
        return $muni->getById($codigo)->Municipio;
    }
    
    public function guardar() {
        $jugador = new Jugador();
        $jugador->Id = $_REQUEST['Id'];
        $jugador->Codigo = $_REQUEST['Codigo'];
        $jugador->Nombre1 = $_REQUEST['Nombre1'];
        $jugador->Nombre2 = $_REQUEST['Nombre2'];
        $jugador->Apellido1 = $_REQUEST['Apellido1'];
        $jugador->Apellido2 = $_REQUEST['Apellido2'];
        $jugador->Genero = $_REQUEST['Genero'];
        $jugador->Cui = $_REQUEST['Cui'];
        $jugador->Correo = $_REQUEST['Correo'];
        $jugador->Fechanac = $_REQUEST['Fechanac'];
        $jugador->Deptonac = $_REQUEST['Deptonac'];
        $jugador->Muninac = $_REQUEST['Muninac'];
        $jugador->Tiposangre = $_REQUEST['Tiposangre'];
        $jugador->Escolaridad = $_REQUEST['Escolaridad'];
        $jugador->Alergias = $_REQUEST['Alergias'];
        $jugador->Nombrepadre = $_REQUEST['Nombrepadre'];
        $jugador->Nombremadre = $_REQUEST['Nombremadre'];
        $jugador->Teljugador = $_REQUEST['Teljugador'];
        $jugador->Telpadre = $_REQUEST['Telpadre'];
        $jugador->Telmadre = $_REQUEST['Telmadre'];
        $jugador->Pasaporte = $_REQUEST['Pasaporte'];
        $jugador->Pasaporteven = $_REQUEST['Pasaporteven'];
        $jugador->Visa = $_REQUEST['Visa'];
        $jugador->Visaven = $_REQUEST['Visaven'];
        $jugador->Visamex = $_REQUEST['Visamex'];
        $jugador->Visamexven = $_REQUEST['Visamexven'];
        $jugador->Nit = $_REQUEST['Nit'];
        
        $codigo = $jugador->Genero == "1" ? "M" : "F";
        $codigo .= date('ymd',strtotime($jugador->Fechanac));
        $codigo .= substr($jugador->Nombre1, 0, 1);
        $codigo .= $jugador->Nombre2 == "" ? "-" : substr($jugador->Nombre2, 0, 1);
        $codigo .= substr($jugador->Apellido1, 0, 1);
        $codigo .= substr($jugador->Apellido2, 0, 1);
        
        $jugador->Codigo = $codigo;
        $jugador->save();
        
        if ($_REQUEST['Id'] != '') {
            $this->object = $this->object->getById($_REQUEST['Id']);
        } else {
            $usuario = new Usuario();
            $usuario->Usuario = strtolower($jugador->Nombre1).".".strtolower($jugador->Apellido1).".".date('y',strtotime($jugador->Fechanac));
            $usuario->Nombre = $jugador->Nombre1 ." ". $jugador->Nombre2 ." ". $jugador->Apellido1 ."  ". $jugador->Apellido2;
            $usuario->Tipo = 2;
            $usuario->Password = $jugador->Codigo;
            $usuario->save();
        }
        
        $this->view("perfil");
    }
}
?>
