<?php
require_once "modelos/personas_MO.php";
require_once "modelos/edificios_MO.php";
class apartamentos_MO{
    private $conexion;

    function __construct($conexion){
        $this->conexion=$conexion;
    }

    function agregarapartamentos($apart_codigo,$edif_codigo,$pers_documento){
        
        $conexion=new conexion('A');
        $personas_MO = new personas_MO($conexion);
        $arreglo_agregar_personas=$personas_MO->seleccionar('',$pers_documento,'');
        $r=$arreglo_agregar_personas[0];

        $conexion=new conexion('A');
        $edificios_MO = new edificios_MO($conexion);
        $arreglo_agregar_edificios=$edificios_MO->seleccionar('',$edif_codigo);
        $e=$arreglo_agregar_edificios[0];
        
        $sql="insert into apartamentos (apart_codigo,pers_id,edif_id) values ('$apart_codigo','$r->pers_id','$e->edif_id')";
        $this->conexion->consultar($sql);
        
    } 

    function actualizarApartamentos($pais_id,$pais_nombre){
        $sql="UPDATE paises SET pais_nombre='$pais_nombre' WHERE pais_id='$pais_id'";
        $this->conexion->consultar($sql);
    }

    function seleccionar($apart_id='',$apart_codigo='',$pers_documento='',$edif_codigo='',$rt='',$e='',$ap=''){
        if($apart_id){
            $sql="select * from apartamento where apart_id='$apart_id'";
        }else if($pers_documento){
            $sql="select * from apartamentos inner join personas on apartamentos.pers_id=personas.pers_id where pers_documento='$pers_documento'";
        }else if($edif_codigo){
            $sql="select * from edificios where edif_codigo='$edif_codigo'";
        }else if($apart_id){
            $sql="select * from apartamentos INNER JOIN edificios on apartamentos.edif_id=edificios.edif_id where apart_id='$apart_id'";
        }else if($rt){
            $sql="select * from personas where pers_documento='$rt'";
        }else if($ap){
            if($e){
            $sql="select edif_codigo,apart_codigo from apartamentos INNER JOIN edificios on apartamentos.edif_id=edificios.edif_id where apart_codigo='$ap'and edif_codigo='$e'";
            }
        }else{
            $sql="select * from apartamentos INNER JOIN edificios on apartamentos.edif_id=edificios.edif_id INNER JOIN personas on apartamentos.pers_id=personas.pers_id";
        }
        $this->conexion->consultar($sql);
        $arreglo=$this->conexion->extraerRegistros();
        return $arreglo;
    } 
}
?>