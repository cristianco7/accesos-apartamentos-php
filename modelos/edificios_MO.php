<?php
class edificios_MO{
    private $conexion;

    function __construct($conexion){
        $this->conexion=$conexion;
    }

    function agregarEdificios($edif_nombre,$edif_codigo){
        $sql="insert into edificios (edif_nombre,edif_codigo) values ('$edif_nombre','$edif_codigo')";
        $this->conexion->consultar($sql);
    } 

    function actualizarEdificios($edif_id,$edif_nombre,$edif_codigo){
        $sql="UPDATE edificios SET edif_nombre='$edif_nombre',edif_codigo='$edif_codigo' WHERE edif_id='$edif_id'";
        $this->conexion->consultar($sql);
    }

    function seleccionar($edif_id='',$edif_codigo=''){
        if($edif_id){
            $sql="select * from edificios where edif_id='$edif_id'";
        }else if($edif_codigo){
            $sql="select * from edificios where edif_codigo='$edif_codigo'";
        }
        else{
            $sql="select * from edificios";
        }
        $this->conexion->consultar($sql);
        $arreglo=$this->conexion->extraerRegistros();
        return $arreglo;
    } 
}
?>