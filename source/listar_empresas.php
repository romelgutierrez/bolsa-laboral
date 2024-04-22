<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

?>


<div class="container-fluid">
    <h1>Lista de Empresas</h1>
    <?php
    $sql = "    SELECT
    e.razon_social,
    e.ruc,
    e.direccion,
    e.telefono,
    e.correo,
    u.nombres AS nombre_usuario, -- Nombre del usuario
    e.id_empresa
FROM
    empresas e
LEFT JOIN
    usuarios u ON e.id_usuario = u.id_usuario";
    $registros = mysqli_query($conexion, $sql);
    
    echo "<table class='table table-success table-hover'>";
    echo "<th>Razón Social</th><th>RUC</th><th>Dirección</th><th>Teléfono</th><th>Correo</th><th>Usuario Asig</th><th>Acciones</th>";
    while ($fila = mysqli_fetch_array($registros)) {
        echo "<tr>";
        echo "<td>".$fila['razon_social']."</td>";
        echo "<td>".$fila['ruc']."</td>";
        echo "<td>".$fila['direccion']."</td>";
        echo "<td>".$fila['telefono']."</td>";
        echo "<td>".$fila['correo']."</td>";
        /* echo "<td>".$fila['id_usuario']."</td>"; */
        echo "<td>".$fila['nombre_usuario']."</td>";

        echo "<td>";
        ?>
        <button type="button" class="btn btn-primary" onClick="f_editar('<?php echo $fila['id_empresa']; ?>');">Editar</button>
        <button type="button" class="btn btn-danger" onClick="f_eliminar('<?php echo $fila['id_empresa']; ?>');">Eliminar</button>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" onClick="f_asignar('<?php echo $fila['id_empresa']; ?>');">
        Asig User
        </button>
        <?php
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <!-- Modal -->

       
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Selecionar un usuario</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <!-- lista lso usuarios -->
             <form method="POST" action="actualizar_empresa.php">
                <input type="text" name="id" value="<?php echo $fila['id_empresa']; ?>">
                <!-- Mostrar usuarios en un elemento select -->
                <div class="row mb-3">
                    <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-10">
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
                    ?>
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
                <!-- <button type="submit" class="btn btn-success">Actualizar Empresa</button> -->
                <button type="submit" class="btn btn-primary">Guardar</button>
              </form>    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
            </div>
        </div>
        </div>

</div>
<script>
function f_editar(id) {
    location.href = "modificar_empresa.php?id=" + id;
}
function f_asignar(id) {
    // Retornar el id sin modificarlo
    location.href = "asignar_empresa.php?id=" + id;
}

function f_eliminar(id) {
    if (confirm('¿Está seguro de eliminar esta empresa?')) {
        location.href = "eliminar_empresa.php?id=" + id;
    }
}

//<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</script>
<?php
include("../includes/foot.php");
?>
