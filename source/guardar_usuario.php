<?php

	include("../includes/conectar.php");

	$conexion = conectar();
	
	//Recibimos los datos del formulario	
	$dni     = $_POST['txt_dni'];
	$nombres = $_POST['txt_nombres'];
	$apellidos = $_POST['txt_apellidos'];
	$telefono  = $_POST['txt_telefono'];
	$usuario  = $_POST['txt_usuario'];
	$contrasenia  = $_POST['txt_contrasenia'];

	/*
	echo "DNI Recibido: ".$dni;
	echo "nombres Recibido: ".$nombres;
	echo "apellidos Recibidos: ".$apellidos;
	echo "telefono Recibido: ".$telefono;
	*/

	//Guardamos los datos en la tabla 'usuarios'

	$sql="INSERT INTO usuarios(dni,nombres,apellidos,telefono,usuario,contrasenia) 
	      VALUES('$dni','$nombres','$apellidos','$telefono','$usuario','$contrasenia') ";

	mysqli_query($conexion,$sql) or die("Error al guardar.");

	header("Location:listar_usuarios.php")

?>