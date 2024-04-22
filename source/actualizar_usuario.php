<?php
    include("../includes/head.php");
    include("../includes/conectar.php");
    $conexion = conectar();

    $id_usuario = $_POST['txt_id_usuario'];

    echo $id_usuario;

    $dni = $_POST['txt_dni'];
    $nombres = $_POST['txt_nombres'];
    $apellidos = $_POST['txt_apellidos'];
    $telefono = $_POST['txt_telefono'];
    $usuario = $_POST['txt_usuario'];
    $contrasenia = $_POST['txt_contrasenia'];


    $sql="UPDATE usuarios 
          SET 
            dni='$dni', 
            nombres='$nombres', 
            apellidos='$apellidos', 
            telefono='$telefono',
            usuario='$usuario',
            contrasenia='$contrasenia'
          WHERE id_usuario='$id_usuario' ";

    mysqli_query($conexion,$sql);

    header("Location:listar_usuarios.php")



?>
