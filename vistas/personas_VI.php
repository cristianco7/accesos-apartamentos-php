
<?php
class personas_VI{
   
    function __construct(){}
    function agregarPersonas(){
        require_once "modelos/personas_MO.php";
        
        $conexion= new conexion('S');
        $personas_MO= new personas_MO($conexion);
        $arreglo=$personas_MO->seleccionar();
        ?>
        <div class="card">
        <div class="card-header">
            Agregar Personas
        </div>
        <div class="card-body">
            <form id="formulario_agregar_personas">
        <div class="row">       
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="pers_nombres">Nombres</label>
                    <input type="text" class="form-control" id="pers_nombres" name="pers_nombres">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="pers_apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="pers_apellidos" name="pers_apellidos">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="pers_documento">Documento</label>
                    <input type="text" class="form-control" id="pers_documento" name="pers_documento">
                </div>
            </div>
        </div>
            <button type="button" onclick="agregarPersonas();" class="btn btn-primary float-right">Agregar</button>
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
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">documento</th>
                <th style="text-align:center;">Acci&oacute;n</th>
            </tr>
        </thead>
        <tbody id = "tabla_personas">
        <?php
            if($arreglo){
                
                foreach($arreglo as $objeto){
                    $pers_id=$objeto->pers_id;
                    $pers_nombres=$objeto->pers_nombres;
                    $pers_apellidos=$objeto->pers_apellidos;
                    $pers_documento=$objeto->pers_documento;
                    ?>
                    <tr>
                    <td id="pers_nombres_<?php echo $pers_id;?>"><?php echo $pers_nombres;?></td>
                    <td id="pers_apellidos_<?php echo $pers_id;?>"><?php echo $pers_apellidos;?></td>
                    <td id="pers_documento_<?php echo $pers_id;?>"><?php echo $pers_documento;?></td>
                    <td style="text-align:center;">
                    <i class="fas fa-pencil-alt" data-toggle="modal" data-target="#ventana_modal" style="cursor:pointer;" onclick="verActualizarPersonas('<?php echo $pers_id;?>');"></i>
                                        
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
            
            function agregarPersonas(){
                var cadena=new FormData(document.querySelector('#formulario_agregar_personas'));
                
                fetch('personas_CO/agregarPersonas', {
                    method: 'POST',
                    body: cadena
                })
            
              .then(respuesta => respuesta.json())
                .then(respuesta=> {
                    let pers_nombres=document.querySelector('#formulario_agregar_personas #pers_nombres').value;
                    let pers_apellidos=document.querySelector('#formulario_agregar_personas #pers_apellidos').value;
                    let pers_documento=document.querySelector('#formulario_agregar_personas #pers_documento').value;
                    if(respuesta.estado=='EXITO'){
                        let pers_id=respuesta.pers_id;
                        let fila=`
                        <tr>
                        <td id="pers_nombres_${pers_id}">${pers_nombres}</td>
                        <td id="pers_apellidos_${pers_id}">${pers_apellidos}</td>
                        <td id="pers_documento_${pers_id}">${pers_documento}</td>
                        <td style="text-align:center;">
                        <i class="fas fa-pencil-alt" data-toggle="modal" data-target="#ventana_modal" style="cursor:pointer;" onclick="verActualizarPersonas('${pers_id}');"></i>
                        
                        </td>
                        </tr>
                        `;
                    let contenido=document.querySelector('#tabla_personas').innerHTML;
                    document.querySelector('#tabla_personas').innerHTML=fila+contenido;
                    document.querySelector('#formulario_agregar_personas').reset();
                    toastr.success(respuesta.mensaje);
                    }else if(respuesta.estado=='ERROR'){
                        toastr.error(respuesta.mensaje);
                    }else{
                        toastr.warning('No se devolvió un estado');
                    }
                });
            }

                function verActualizarPersonas(pers_id){
                
                let pers_nombres=document.querySelector('#pers_nombres_'+pers_id).innerHTML;
                let pers_apellidos=document.querySelector('#pers_apellidos_'+pers_id).innerHTML;
                let pers_documento=document.querySelector('#pers_documento_'+pers_id).innerHTML;
                var cadena=`
                <div class="card">
                    <div class="card-body">
                        <form id="formulario_actualizar_personas">
                        <div class="form-group">
                            <label for="pers_nombres">Nombres</label>
                            <input type="text" class="form-control" id="pers_nombres" name="pers_nombres" value="${pers_nombres}">
                        </div>
                        <div class="form-group">
                            <label for="pers_apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="pers_apellidos" name="pers_apellidos" value="${pers_apellidos}">
                        </div>
                        <div class="form-group">
                            <label for="pers_documento">Documento</label>
                            <input type="text" class="form-control" id="pers_documento" name="pers_documento" value="${pers_documento}">
                        </div>
                        <input type="hidden" id="pers_id" name="pers_id" value="${pers_id}">
                        <button type="button" onclick="actualizarPersonas();" class="btn btn-primary float-right">Actualizar</button>
                        </form>
                    </div>
                 </div>
                    `;
                    document.querySelector('#titulo_modal').innerHTML='Actualizar personas';
                    document.querySelector('#contenido_modal').innerHTML=cadena;
                }

                
                function actualizarPersonas(){

                    var cadena=new FormData(document.querySelector('#formulario_actualizar_personas'));
                    
                    fetch('personas_CO/actualizarPersonas', {
                    method: 'POST',
                    body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                    if(respuesta.estado=='EXITO'){

                        let pers_nombres=document.querySelector('#formulario_actualizar_personas #pers_nombres').value;
                        let pers_apellidos=document.querySelector('#formulario_actualizar_personas #pers_apellidos').value;
                        let pers_documento=document.querySelector('#formulario_actualizar_personas #pers_documento').value;
                        let pers_id=document.querySelector('#formulario_actualizar_personas #pers_id').value;

                        document.querySelector('#pers_nombres_'+pers_id).innerHTML=pers_nombres;
                        document.querySelector('#pers_apellidos_'+pers_id).innerHTML=pers_apellidos;
                        document.querySelector('#pers_documento_'+pers_id).innerHTML=pers_documento;
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