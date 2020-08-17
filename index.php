<?php 
	include_once 'Modelo/ModeloUsuario.php';
	include_once 'Modelo/Consultas.php';
	$Usuario = new User();
	$Consultas = new Consultas();
	if(!$_POST == null){
		if(isset($_POST['cor']) && isset($_POST['pass'])){
			$Alias = $_POST['cor'];
			$Password = $_POST['pass'];
			if($Usuario->ExistUsuario($Alias, $Password)) {
				$data = $Usuario->ExistUsu($Alias);
				$id = $Usuario->getIdUsuario($Alias, 1);
				$Consultas->actualizarEstado($id, "usuario");
				if($data != false){
					$R = array('Code' => 1, 'Estado' => "Usuario Ya Registrado", "data" =>$data);
   				echo json_encode($R);
				}else{
					$R = array('Code' => 5, 'Estado' => "No Se a Podido Obtener datos del usuario");
   					echo json_encode($R);
				}
			}else{
				$R = array('Code' => 2, 'Estado' => "Hay un problema con su correo y/o contraseña");
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