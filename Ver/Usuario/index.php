<?php 

	require '../../Modelo/Consultas.php';
	$Consultas = new Consultas();
	$res = $Consultas->verUsuarios();
	echo json_encode($res);