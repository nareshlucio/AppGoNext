<?php 
	include_once '../../Modelo/Consultas.php';
	include_once '../../Modelo/recuperacion_clave.php';
	$Consultas = new Consultas();
if(isset($_GET['p'])){
	$url = $_GET['p'];
	$id_usu = $Consultas->url_secreta_existe($url);
	if($id_usu != null){
		if(isset($_POST['con1']) && isset($_POST['con2'])){
			$con1 = $_POST['con1'];
 			$con2 = $_POST['con2'];
 			if($con1 === $con2){
 				if ($Consultas->ActualizarContra(password_hash($con1, PASSWORD_BCRYPT), $id_usu)){
            		if($Consultas->Borrar_Cambio($id_usu)){
            			$R = array('Code' => 3, 'Estado' => "Se a Realizado el cambio de su contraseña");
   						echo json_encode($R);
            		}
 				}else{
 					$R = array('Code' => 2, 'Estado' => "Fallo al Cambiar la Contraseña");
   					echo json_encode($R);
 				}
 			}else{
 				$R = array('Code' => 3, 'Estado' => "Las Contraseñas no coinciden");
   				echo json_encode($R);
 			}
		}else{
			$R = array('Code' => 4, 'Estado' => "No Recibo ninguna de las Contraseñas");
   		echo json_encode($R);
		}
	}else{
 		$R = array('Code' => 5, 'Estado' => "Error al encotrar al usuario");
   		echo json_encode($R);
 	}
}else{
	$R = array('Code' => 404, 'Estado' => "No Existe este Sitio");
   		echo json_encode($R);
}