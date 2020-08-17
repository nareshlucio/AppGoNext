<?php 
require '../../Modelo/ModeloUsuario.php';
require '../../Modelo/Consultas.php';
$Usuario = new User();
$Consultas = new Consultas();
if(!$_POST == null){
	if($Usuario->ExistConductor($_POST["cor"])){
		$R = array('Code' => 1, 'Estado' => "Estos datos ya estan Asociado a una cuenta");
   		echo json_encode($R);
	}else if($_POST["ape"] == "" && $_POST["nom"] == "" && $_POST["marc"] == "" && $_POST["cor"] == "" && $_POST["pass"] == "" && $_POST["tel"] == "" && $_POST["model"] == "" && $_POST["matri"] == ""){
		$R = array('Code' => 5, 'Estado' => "Los campos no pueden estar vacios");
   		echo json_encode($R);
	}else if($Usuario->registroConductor($_POST["nom"], $_POST["ape"], $_POST["cor"], $_POST["pass"], $_POST["marc"], $_POST["model"], $_POST["matri"], $_POST["tel"])){
		$id = $Usuario->getIdUsuario($_POST["cor"], 2);
		if($Usuario->registroActividad($id, "conductor")){
			$r = array('Code' => 2, 'Estado' => "Usuario ".$_POST["nom"]." y Automovil ".$_POST["matri"]." Registrado Exitosamente!!!");
   		echo json_encode($r);
   		
		}else{
			$r = array('Code' => 6, 'Estado' => "A Ocurrido un error al registrar la actividad del usuario");
   		echo json_encode($r);
		}
	}else{
		$R = array('Code' => 3, 'Estado' => "Fallo al registrar el Usuario y el Automovil");
   		echo json_encode($R);
	}
}else{
	$R = array('Code' => 4, 'Estado' => "No Recibo ningun Dato");
   		echo json_encode($R);
}