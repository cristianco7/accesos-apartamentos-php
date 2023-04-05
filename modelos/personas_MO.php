<?php
class personas_MO{
    private $conexion;

    function __construct($conexion){
        $this->conexion=$conexion;
    }

    function agregarPersonas($pers_documento,$pers_nombres,$pers_apellidos){
        $sql="insert into personas (pers_nombres,pers_apellidos,pers_documento) values ('$pers_nombres','$pers_apellidos','$pers_documento')";
        $this->conexion->consultar($sql);
    } 

    function actualizarPersonas($pers_id,$pers_nombres,$pers_apellidos,$pers_documento){
        $sql="UPDATE personas SET pers_nombres='$pers_nombres',pers_apellidos='$pers_apellidos',pers_documento='$pers_documento' WHERE pers_id='$pers_id'";
        $this->conexion->consultar($sql);
    }

    function eliminarPersonas($pers_id){
        $sql="DELETE FROM personas WHERE pers_id='$pers_id'";
        $this->conexion->consultar($sql);
    }

    function seleccionar($pers_id='',$pers_documento='',$pers_apellidos=''){
        if($pers_id){
            $sql="select * from personas where pers_id='$pers_id'";
        }else if($pers_documento){
        $sql="select * from personas where pers_documento='$pers_documento'";
        }else{
            $sql="select * from personas";
        }
        $this->conexion->consultar($sql);
        $arreglo=$this->conexion->extraerRegistros();
        return $arreglo;
    } 
}
?>