<?php
class apartamentos_VI{
   
    function __construct(){}
    function agregarApartamentos(){
        require_once "modelos/apartamentos_MO.php";
        require_once "modelos/personas_MO.php";
        require_once "modelos/edificios_MO.php";
        $conexion=new conexion('S');

        $apartamentos_MO=new apartamentos_MO($conexion);

        $arreglo=$apartamentos_MO->seleccionar();
        ?>
        <div class="card">
        <div class="card-header">
            Asignar Apartamento
        </div>
        <div class="card-body">
            <form id="formulario_agregar_apartamentos">
            
        <div class="row">       
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="apart_codigo">Codigo del Apartamento</label>
                    <input type="text" class="form-control" id="apart_codigo" name="apart_codigo">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="pers_documento">Documento del beneficiario</label>
                    <input type="text" class="form-control" id="pers_documento" name="pers_documento">
            </div>

            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="edif_codigo">Codigo del edificio</label>
                    <input type="text" class="form-control" id="edif_codigo" name="edif_codigo">
            </div>

            </div>
            
            
        </div>
            <button type="button" onclick="agregarApartamentos();" class="btn btn-primary float-right">Agregar</button>
            </form>
        </div>
        </div>

        <div class="card">
        <div class="card-header">
            Listar
        </div>
        <div class="card-body">
        <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
            <th>Codigo Apartamento</th>
            <th>Codigo Edificio</th>
            <th>Documento persona</th>
            
            </tr>
        </thead>
        <tbody id="tabla_apartamentos">
        <?php
            if($arreglo){
                foreach($arreglo as $objeto){
                    $apart_id=$objeto->apart_id;
                    $apart_codigo=$objeto->apart_codigo;
                    $edif_codigo=$objeto->edif_codigo;
                    $edif_nombre=$objeto->edif_nombre;
                    $pers_documento=$objeto->pers_documento;
                    
                    ?>
                    <tr>
                    <td id="apart_codigo_<?php echo $apart_id;?>"><?php echo $apart_codigo;?></td>
                    <td id="edif_codigo_<?php echo $apart_id;?>"><?php echo $edif_codigo, "  ", $edif_nombre?></td>
                    <td id="pers_documento_<?php echo $apart_id;?>"><?php echo $pers_documento;?></td>
                    <td style="text-align:center;">
                        
                    </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
           
            </table>
            
        </div>
        </div>
        <script>

            function agregarApartamentos(){
                
                var cadena=new FormData(document.querySelector('#formulario_agregar_apartamentos'));
                
                fetch('apartamentos_CO/agregarapartamentos', {
                    method: 'POST',
                    body: cadena
                })
                .then(respuesta=>respuesta.json())
                .then(respuesta=>{
                       
                    if(respuesta.estado="EXITO"){
                        toastr.error(respuesta.mensaje);
                    }else if(respuesta.estado="ERROR"){
                        toastr.error(respuesta.mensaje);

                    }
                })
            
            }
            
        
        </script>
        <?php
    }

}

?>