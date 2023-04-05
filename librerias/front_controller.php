<?php
class front_controller{
    function __construct($ruta){
        if(empty($ruta)){
            
            $clase='menu_VI';
            $metodo='verMenu';
            $carpeta='vistas';
        }else{
            list($clase,$metodo)=explode('/',$ruta);
            $sufijo = substr($clase,-2);

            if($sufijo=='VI'){
                $carpeta='vistas';
            }else if($sufijo=='CO'){
                $carpeta="controladores";
            }


        }
        require_once $carpeta."/".$clase.".php";
        $instancia = new $clase();
        $instancia ->$metodo();
    }
}

?>