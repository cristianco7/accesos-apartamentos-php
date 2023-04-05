<?php
class conexion{
    private $enlace;
    private $resultado;
    
    function __construct($opcion){
        $ip_maquina=IP_MAQUINA;
        $base_de_datos=BASE_DE_DATOS;
        if($opcion=='S'){
            $usuario=SEL_B;
            $clave=CLAVE_SEL_B;
        }else if($opcion=='A'){
            $usuario=ALL_B;
            $clave=CLAVE_ALL_B;
        }
        try {
            $this->enlace = new PDO("mysql:host=$ip_maquina;dbname=$base_de_datos", $usuario, $clave);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }
    function consultar($sql){
        $this->resultado=$this->enlace->query($sql) or $this->errorConsultar($sql);
    }
    function extraerRegistros(){

        return $this->resultado->fetchAll(PDO::FETCH_OBJ);

    }
    function filasAfectadas(){
        if($this->resultado->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    function lastInsertId(){
        return $this->enlace->lastInsertId();
    }
    function errorConsultar($sql){
        $arreglo_respuesta=[
            "estado"=>"ERROR",
            "mensaje"=>"consulta mal estructurada: $sql"
        ];
        exit(json_encode($arreglo_respuesta));
    }
}
?>