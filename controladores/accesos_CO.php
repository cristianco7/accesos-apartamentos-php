<?php
require_once "modelos/accesos_MO.php";
class accesos_CO{
    function __construct(){}
    
    function iniciarSesion($acce_usuario,$acce_clave){

        $conexion=new conexion('S');
        $accesos_MO = new accesos_MO($conexion);
        $arreglo = $accesos_MO->iniciarSesion($acce_usuario,$acce_clave);
        if($arreglo){
            $pers_id=$arreglo[0]->pers_id;
            $_SESSION['pers_id']=$pers_id;
        }
        header('Location: index.php');
    }
    function cerrarSesion(){
        session_destroy();
    }
}
?>