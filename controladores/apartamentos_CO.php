<?php
require_once "modelos/apartamentos_MO.php";
require_once "modelos/personas_MO.php";
require_once "modelos/edificios_MO.php";
class apartamentos_CO{
    function __construct(){}
    function agregarapartamentos(){

        $conexion=new conexion('A');
        $apartamentos_MO = new apartamentos_MO($conexion);
        $apart_codigo=htmlentities($_POST['apart_codigo'], ENT_QUOTES);
        if(strlen($apart_codigo)>10){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El codigo del apartamento solo acepta 10 caracteres"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        if(empty($apart_codigo)){

            $arreglo_respuesta=[
            'estado'=>"ERROR",
            'mensaje'=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $edif_codigo=htmlentities($_POST['edif_codigo'], ENT_QUOTES);
        if(empty($edif_codigo)){

            $arreglo_respuesta=[
            'estado'=>"ERROR",
            'mensaje'=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }
        $arreglo_edificio=$apartamentos_MO->seleccionar('','','',$edif_codigo);
        if(empty($arreglo_edificio)){
            $arreglo_respuesta=[
                'estado'=>"ERROR",
                'mensaje'=>"El codigo del edificio no se encuentra registrado"
                ];
                exit(json_encode($arreglo_respuesta));
        }
       
        
        $pers_documento=htmlentities($_POST['pers_documento'], ENT_QUOTES);
        if(empty($pers_documento)){

            $arreglo_respuesta=[
            'estado'=>"ERROR",
            'mensaje'=>"Por favor llene todos los campos"
            ];
            exit(json_encode($arreglo_respuesta));
        }

        $arreglo_documento=$apartamentos_MO->seleccionar('','',$pers_documento,'');
        if($arreglo_documento)
        {
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El documento $pers_documento ya es beneficiario"
            ];
            exit(json_encode($arreglo_respuesta));
            
        }
        $rt=$pers_documento;
        $arreglo_personas=$apartamentos_MO->seleccionar('','','','',$rt);

        if(empty($arreglo_personas)){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El documento $pers_documento no se encuentra registrado en Personas"
            ];
            exit(json_encode($arreglo_respuesta));
            
        }
        $e=$edif_codigo;
        $ap=$apart_codigo;
        $arreglo_q=$apartamentos_MO->seleccionar('','','','','',$e,$ap);
        $a=$arreglo_q;
        if($a){
            $arreglo_respuesta=[
                "estado"=>"ERROR",
                "mensaje"=>"El apartamento ya fue asignado"
            ];
            exit(json_encode($arreglo_respuesta));
            
        }
        
        
        
        $apartamentos_MO->agregarapartamentos($apart_codigo,$edif_codigo,$pers_documento);
        $actualizado=$conexion->filasAfectadas();
        $apart_id=$conexion->lastInsertId();
        $arreglo_respuesta=[
            "apart_id"=>$apart_id,
            "estado"=>"ERROR",
            "mensaje"=>"Registro Agregado"
        ];
        exit(json_encode($arreglo_respuesta));
    }

    
}

?>