<?php 
require '../../Modelo/ModeloUsuario.php';
require '../../Modelo/Consultas.php';
$Usuario = new User();
$Consultas = new Consultas();
var_dump($_POST);
if(!$_POST == null){

	if($Usuario->ExistUsu($_POST["cor"]) || $Usuario->ExistUsu($_POST["ali"])){

		$R = array('Code' => 1, 'Estado' => "Estos datos ya estan Asociado a una cuenta");
   		echo json_encode($R);

	}else if($_POST["ape"] == "" && $_POST["nom"] == "" && $_POST["ali"] == "" && $_POST["cor"] == "" && $_POST["pas"] == "" && $_POST["tel"] == "" && $_POST["eda"] == ""){

		$R = array('Code' => 5, 'Estado' => "Los campos no pueden estar vacios");
   		echo json_encode($R);

	}else if($Usuario->RegistroUsu($_POST["ape"], $_POST["nom"], $_POST["ali"], $_POST["cor"], $_POST["pas"], $_POST["tel"], $_POST["eda"])){

		$id = $Usuario->getIdUsuario($_POST["cor"], 1);
		if($Usuario->registroActividad($id, "usuario");){
			$r = array('Code' => 2, 'Estado' => "Usuario ".$_POST["ali"]." Registrado Exitosamente!!!");
   			echo json_encode($r);
   			
		}else{

			$r = array('Code' => 6, 'Estado' => "A ocurrido un error al registrar la acividad del usuario");
   			echo json_encode($r);
		}

	}else{
		$R = array('Code' => 3, 'Estado' => "Fallo al registrar el Usuario");
   		echo json_encode($R);
	}
}else{
	$R = array('Code' => 4, 'Estado' => "No Recibo ningun Dato");
   		echo json_encode($R);
}