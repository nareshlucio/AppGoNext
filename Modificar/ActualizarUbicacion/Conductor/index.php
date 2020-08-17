<?php 
	include_once '../../../Modelo/Consultas.php';
	$Consultas = new Consultas();
	if(!$_POST == null){
		if(isset($_POST['id']) && isset($_POST['long']) && isset($_POST['lat'])){
			if(actualizarCord($_POST['id'], $_POST['lat'], $_POST['long'], "conductor")) {
					$R = array('Code' => 1, 'Estado' => "Posicion Actualizada");
   				echo json_encode($R);
			}else{
				$R = array('Code' => 2, 'Estado' => "Falta Informacion/ a ocurrido algun error");
   				echo json_encode($R);
			}
		}else{
			$R = array('Code' => 3, 'Estado' => "No recibo los datos solicitados");
   				echo json_encode($R);
		}
	}else{
		$R = array('Code' => 4, 'Estado' => "Hay algun problema con el Servidor");
   			echo json_encode($R);
	}