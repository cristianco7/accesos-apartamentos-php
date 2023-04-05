<?php
require_once "modelos/edificios_MO.php";
class edificios_CO{
    function __construct(){}
    
    function agregarEdificios(){

        $conexion=new conexion('A');
        $edificios_MO = new edificios_MO($conexion);
        $edif_nombre=htmlentities($_POST['edif_nombre'], ENT_QUOTES);
        if(empty($edif_nombre)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $edif_codigo=htmlentities($_POST['edif_codigo'], ENT_QUOTES);
        if(empty($edif_codigo)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        if(strlen($edif_codigo)>45){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El codigo del edificio solo acepta 45 caracteres"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $arreglo=$edificios_MO->seleccionar('',$edif_codigo,'');
        if($arreglo)
        {
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El codigo $edif_codigo ya se encuentra registrado en la base de datos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $edificios_MO->agregarEdificios($edif_nombre,$edif_codigo);
        $edif_id=$conexion->lastInsertId();
        $arreglo_respuesta=[
            "edif_id"=>$edif_id,
            "estado"=>"EXITO",
            "mensaje"=>"Registro Agregado"
        ];
        exit(json_encode($arreglo_respuesta));
    }

    function actualizarEdificios(){

        $conexion=new conexion('A');
        $edificios_MO = new edificios_MO($conexion);
        $edif_id=$_POST['edif_id'];
        $edif_codigo=htmlentities($_POST['edif_codigo'], ENT_QUOTES);
        if(empty($edif_codigo)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        
        $edif_nombre=htmlentities($_POST['edif_nombre'], ENT_QUOTES);
        if(empty($edif_nombre)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $edificios_MO->actualizarEdificios($edif_id,$edif_nombre,$edif_codigo);
        $actualizado=$conexion->filasAfectadas();
        
        if($actualizado){
            $mensaje="Registro Actualizado";
            $estado='EXITO';
        }else{
            $mensaje="No se realizaron cambios";
            $estado='ADVERTENCIA';
        }
        $arreglo_respuesta=[
            "estado"=>$estado,
            "mensaje"=>$mensaje
        ];
        exit(json_encode($arreglo_respuesta));
    }
}

?>