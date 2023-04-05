<?php
require_once "librerias/constantes.php";
require_once "librerias/conexion.php";
if(isset($_SESSION['pers_id'])){
    require_once "librerias/front_controller.php";
    if(isset($_GET['ruta'])){
        $ruta=$_GET['ruta'];
    }else{
        $ruta='';
    }
    $front_controller = new front_controller($ruta);
}
else if(isset($_POST['usuario']) && isset($_POST['clave'])){
    require_once "controladores/accesos_CO.php";
    $acce_usuario=$_POST['usuario'];
    $acce_clave=$_POST['clave'];

    $accesos_CO= new accesos_CO();
    $accesos_CO->iniciarSesion($acce_usuario,$acce_clave);    
}else{
    require_once "vistas/accesos_VI.php";
    $accesos_VI= new accesos_VI();
    $accesos_VI->iniciarSesion();
}

?>