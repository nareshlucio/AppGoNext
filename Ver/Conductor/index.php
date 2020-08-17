<?php 

	require '../../Modelo/Consultas.php';
	$Consultas = new Consultas();
	$res = $Consultas->verConductores();
	echo json_encode($res);