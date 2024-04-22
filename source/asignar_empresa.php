<?php
    include("../includes/head.php");
    include("../includes/conectar.php");

    $conexion = conectar();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
   

    <?php
        // Obtener el ID de la empresa de la solicitud
        $id = $_REQUEST['id'];

        // Consulta para obtener los datos de la empresa específica
        $sql = "SELECT * FROM empresas WHERE id_empresa='$id'";
        $registro = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($registro);

        // Consulta para obtener todos los usuarios de la base de datos
        $sql_usuarios = "SELECT id_usuario, nombres FROM usuarios";
        $usuarios = mysqli_query($conexion, $sql_usuarios);

        // Consulta para obtener los datos de la empresa específica, incluyendo el nombre de la empresa
        $sql = "SELECT id_empresa, razon_social, id_usuario FROM empresas WHERE id_empresa='$id'";
       // $registro = mysqli_query($conexion, $sql);
       // $fila = mysqli_fetch_array($registro);

    ?>


    <div class="container text-center">
        <div class="row">
            <div class="col">
            
            </div>
            <div class="col">
                
            <h3>Asignar un usuario para la administración de: </h3>
            <div class="bg-success text-white p-2">
                <?php echo $fila['razon_social']; ?>
            </div>
            <form method="POST" action="actualizar_empresa.php">
                    <input type="hidden" name="id" value="<?php echo $fila['id_empresa']; ?>">
                    <div class="row mb-3">
                        <label for="razon_social" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="razon_social" value="<?php echo $fila['razon_social']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ruc" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="ruc" value="<?php echo $fila['ruc']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="direccion" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="direccion" value="<?php echo $fila['direccion']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="telefono" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="telefono" value="<?php echo $fila['telefono']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="correo" class="col-sm-2 col-form-label"> </label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="correo" value="<?php echo $fila['correo']; ?>">
                        </div>
                    </div>

                    <!-- Mostrar usuarios en un elemento select -->
                    <div class="row mb-3">
                        <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_usuario">
                                <?php
                                // Genera opciones para cada usuario
                                while ($usuario = mysqli_fetch_array($usuarios)) {
                                    $selected = $usuario['id_usuario'] == $fila['id_usuario'] ? 'selected' : '';
                                    echo "<option value='{$usuario['id_usuario']}' $selected>{$usuario['nombres']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                </form>
            </div>
            <div class="col">
           
            </div>
        </div>
    </div>

    <!-- Fin de la zona central del sistema -->
</div>
<!-- /.container-fluid --> 

<?php
    include("../includes/foot.php");
?>
