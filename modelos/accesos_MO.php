<?php
class accesos_MO{
    private $conexion;

    function __construct($conexion){
        $this->conexion=$conexion;
    }

    function iniciarSesion($acce_usuario,$acce_clave){
        $sql="select pers_id from accesos where acce_usuario='$acce_usuario' and acce_clave='$acce_clave'";
        $this->conexion->consultar($sql);
        $arreglo=$this->conexion->extraerRegistros();
        return $arreglo;
    } 
    
}
?>