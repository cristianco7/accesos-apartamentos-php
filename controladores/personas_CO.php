<?php
require_once "modelos/personas_MO.php";
class personas_CO{
    function __construct(){}
    
    function agregarPersonas(){
        
        $conexion=new conexion('A');
        $personas_MO = new personas_MO($conexion);
        $pers_documento=htmlentities($_POST['pers_documento'], ENT_QUOTES);
        if(empty($pers_documento)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $arreglo=$personas_MO->seleccionar('',$pers_documento,'');
        if($arreglo)
        {
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El documento $pers_documento ya se encuentra registrado en la base de datos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $pers_nombres=htmlentities($_POST['pers_nombres'], ENT_QUOTES);
        if(empty($pers_nombres)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $pers_apellidos=htmlentities($_POST['pers_apellidos'], ENT_QUOTES);
        if(empty($pers_apellidos)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $arreglo=$personas_MO->seleccionar('',$pers_documento);
        if($arreglo)
        {
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El .'$pers_documento'. documento ya se encuentra registrado en la base de datos"
            ];
        }
        if(strlen($pers_documento)>45){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El documento solo acepta 45 caracteres"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $personas_MO->agregarPersonas($pers_documento,$pers_nombres,$pers_apellidos);
        $pers_id=$conexion->lastInsertId();
        
        $arreglo_respuesta=[
            "pers_id"=>$pers_id,
            "estado"=>"EXITO",
            "mensaje"=>"Registro Agregado"
        ];
        exit(json_encode($arreglo_respuesta));
        
    }

    function actualizarPersonas(){
        
        $conexion=new conexion('A');
        $personas_MO = new personas_MO($conexion);
        $pers_id=$_POST['pers_id'];
        $pers_nombres=htmlentities($_POST['pers_nombres'], ENT_QUOTES);
        if(empty($pers_nombres)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $pers_apellidos=htmlentities($_POST['pers_apellidos'], ENT_QUOTES);
        if(empty($pers_apellidos)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $pers_documento=htmlentities($_POST['pers_documento'], ENT_QUOTES);
        if(empty($pers_documento)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        
        $personas_MO->actualizarPersonas($pers_id,$pers_nombres,$pers_apellidos,$pers_documento);
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