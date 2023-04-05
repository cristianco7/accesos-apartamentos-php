<?php
class edificios_VI{
   
    function __construct(){}
    function agregarEdificios(){
        require_once "modelos/edificios_MO.php";
        $conexion= new conexion('S');
        $edificios_MO= new edificios_MO($conexion);
        $arreglo=$edificios_MO->seleccionar();
        ?>
        <div class="card">
        <div class="card-header">
            Agregar Edificios
        </div>
        <div class="card-body">
            <form id="formulario_agregar_edificios">
        <div class="row">       
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="depo_nombre">Nombre del edificio</label>
                    <input type="text" class="form-control" id="edif_nombre" name="edif_nombre">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="edif_codigo">Codigo del edificio</label>
                    <input type="text" class="form-control" id="edif_codigo" name="edif_codigo">
                </div>
            </div>
        </div>
            <button type="button" onclick="agregarEdificios();" class="btn btn-primary float-right">Agregar</button>
            </form>
        </div>
        </div>
      <!------------------------------------------------------------------------------------------------------------------->
        <div class="card">
        <div class="card-header">
            Listar
        </div>
        <div class="card-body">
        <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Nombre edificio</th>
                <th scope="col">Codigo edificio</th>
                <th style="text-align:center;">Acci&oacute;n</th>
            </tr>
        </thead>
        <tbody id = "tabla_edificios">
        <?php
            if($arreglo){
                
                foreach($arreglo as $objeto){
                    $edif_id=$objeto->edif_id;
                    $edif_nombre=$objeto->edif_nombre;
                    $edif_codigo=$objeto->edif_codigo;
                    ?>
                    <tr>
                    <td id="edif_nombre_<?php echo $edif_id;?>"><?php echo $edif_nombre;?></td>
                    <td id="edif_codigo_<?php echo $edif_id;?>"><?php echo $edif_codigo;?></td>
                    <td style="text-align:center;">
                        <i class="fas fa-pencil-alt" data-toggle="modal" data-target="#ventana_modal" style="cursor:pointer;" onclick="verActualizarEdificios('<?php echo $edif_id;?>');"></i>
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
        <!---------------------------------------------------------------------------------------------------------------------------->
        <script>
            function agregarEdificios(){
                var cadena=new FormData(document.querySelector('#formulario_agregar_edificios'));
                
                fetch('edificios_CO/agregarEdificios', {
                    method: 'POST',
                    body: cadena
                })
            
              .then(respuesta => respuesta.json())
                .then(respuesta=> {
                    let edif_nombre=document.querySelector('#formulario_agregar_edificios #edif_nombre').value;
                    let edif_codigo=document.querySelector('#formulario_agregar_edificios #edif_codigo').value;
                    if(respuesta.estado=='EXITO'){
                        let edif_id=respuesta.edif_id;
                        let fila=`
                        <tr>
                        <td id="edif_nombre_${edif_id}">${edif_nombre}</td>
                        <td id="edif_codigo_${edif_id}">${edif_codigo}</td>
                        <td style="text-align:center;">
                        <i class="fas fa-pencil-alt" data-toggle="modal" data-target="#ventana_modal" style="cursor:pointer;" onclick="verActualizarEdificios('${edif_id}');"></i>
                        </td>
                        </tr>
                        `;
                    let contenido=document.querySelector('#tabla_edificios').innerHTML;
                    document.querySelector('#tabla_edificios').innerHTML=fila+contenido;
                    document.querySelector('#formulario_agregar_edificios').reset();
                    toastr.success(respuesta.mensaje);
                    }else if(respuesta.estado=='ERROR'){
                        toastr.error(respuesta.mensaje);
                    }else{
                        toastr.warning('No se devolvió un estado');
                    }
                });
            }

                function verActualizarEdificios(edif_id){
                
                let edif_nombre=document.querySelector('#edif_nombre_'+edif_id).innerHTML;
                let edif_codigo=document.querySelector('#edif_codigo_'+edif_id).innerHTML;
                var cadena=`
                <div class="card">
                    <div class="card-body">
                        <form id="formulario_actualizar_edificios">
                        <div class="form-group">
                            <label for="edif_nombre">Nombre del edificio</label>
                            <input type="text" class="form-control" id="edif_nombre" name="edif_nombre" value="${edif_nombre}">
                        </div>
                        <div class="form-group">
                            <label for="edif_codigo">Codigo del edificio</label>
                            <input type="text" class="form-control" id="edif_codigo" name="edif_codigo" value="${edif_codigo}">
                        </div>
                        <input type="hidden" id="edif_id" name="edif_id" value="${edif_id}">
                        <button type="button" onclick="actualizarEdificios();" class="btn btn-primary float-right">Actualizar</button>
                        </form>
                    </div>
                 </div>
                    `;
                    document.querySelector('#titulo_modal').innerHTML='Actualizar Edificio';
                    document.querySelector('#contenido_modal').innerHTML=cadena;
                }

                function actualizarEdificios(){

                    var cadena=new FormData(document.querySelector('#formulario_actualizar_edificios'));
                    fetch('edificios_CO/actualizarEdificios', {
                    method: 'POST',
                    body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                    if(respuesta.estado=='EXITO'){

                        let edif_nombre=document.querySelector('#formulario_actualizar_edificios #edif_nombre').value;
                        let edif_codigo=document.querySelector('#formulario_actualizar_edificios #edif_codigo').value;
                        let edif_id=document.querySelector('#formulario_actualizar_edificios #edif_id').value;

                        document.querySelector('#edif_nombre_'+edif_id).innerHTML=edif_nombre;
                        document.querySelector('#edif_codigo_'+edif_id).innerHTML=edif_codigo;
                        toastr.success(respuesta.mensaje);

                    }else if(respuesta.estado=='ERROR'){
                        toastr.error(respuesta.mensaje);
                        }else if(respuesta.estado=='ADVERTENCIA'){
                        toastr.warning(respuesta.mensaje);
                        }else{
                        toastr.info('No se devolvió un estado');
                     }
                   
                    });
                }
    </script>
        <?php
    }

}

?>