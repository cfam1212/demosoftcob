<?php 

require_once '../dashmenu/panel_menu.php'; 

$consulta = "CALL sp_consulta_datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0,$_SESSION["i_emprcodigo"],'','','','','','',0,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>DataTables</h1> -->
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-fluid">
        <div class="container">
            <br />                
            <div class="row">            
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">                            
                            <button type="button" class="btn btn-outline-primary" id="btnNuevo" style="margin-bottom:10px"><i class="fas fa-plus"></i> Nuevo</button>
                        </div>
                        <div class="card-body">
                            <table id="tabledata" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tarea</th>
                                        <th>Acción</th>
                                        <th>Icono</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($data as $datos){
                                    ?>  
                                        <?php
                                            if($datos['TareaId']=='100001' || $datos['TareaId'] == "100002" || $datos['TareaId'] == "100003" 
                                                || $datos['TareaId'] == "100004"){
                                                $disabledel = 'disabled="disabled"';
                                            }else{
                                                $disabledel = '';
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $datos['TareaId'] ?></td>
                                            <td><?php echo $datos['Tarea'] ?></td>
                                            <td><?php echo $datos['Ruta'] ?></td>
                                            <td><?php echo $datos['Icono'] ?></td>
                                            <td><?php echo $datos['Estado'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar">
                                                        <i class="fas fa-file"></i></button>
                                                        <button class="btn btn-outline-danger btn-sm ml-3" <?php echo $disabledel ?> id="btnEliminar">
                                                        <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div> 
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>                          
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modalTAREA" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTarea">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tarea" class="col-form-label">Tarea:</label>
                        <input type="text" required class="form-control" id="txtTarea">
                    </div>
                    <div class="form-group">
                        <label for="ruta" class="col-form-label">Ruta:</label>
                        <input type="text" required class="form-control" id="txtRuta" placeholder="ej: ../seguridad/usuario.php">
                    </div>
                    <div class="form-group">
                        <label for="icono" class="col-form-label">Icono:</label>
                        <input type="text" class="form-control" id="txtIcono" placeholder="ej: fas fa-user">
                    </div>                    
                    <div class="form-check" id="divcheck">
                        <input type="checkbox" class="form-check-input" id="chkEstado">
                        <label for="estadolabel" class="form-check-label" id="lblEstado">Activo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <!-- <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button> -->
                    <button type="submit" class="btn btn-outline-primary ml-3" id="btnSave"><i class='fas fa-bookmark'></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div> 

    <?php require_once '../dashmenu/panel_footer.php'; ?>
    <script src="../codejs/tareas.js" type="text/javascript"></script>

    </body>
</html>