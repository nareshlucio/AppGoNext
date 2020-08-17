<?php 
	include_once '../../Modelo/ModeloUsuario.php';
	include_once '../../Modelo/Consultas.php';
	include_once '../../Modelo/recuperacion_clave.php';
	$Usuario = new User();
	$Consultas = new Consultas();
	if(!$_POST == null){
		if(isset($_POST['cor'])){

            if($Usuario->ExistUsu($_POST["cor"])){

            $correo = $_POST["cor"];
            $url = $Consultas->ExistCorreo_recuperar($correo);
            $urlencr=hash('sha256', $url);
            $Token = $Consultas->Token();
            //Inicio de la recuperacion
            $recu = new Recuperacion($Consultas->id_usuario, $urlencr, $Token, date("Y-m-d H:i:s"));
            $peticion = $recu->generar_peticion($recu->conexionPDO(), $recu->id_usuario ,$recu->url_secreta, $recu->token);
            if($peticion){
                $R = array('Code' => 1, 'Estado' => "Correo Enviado para el Cambio de Contraseña");
                echo json_encode($R);
                $mensaje = "<h1>Usted a solicitado un cambio de contraseña a continuacion de click en el enlace para poder proceder a dicho proceso.</h1><br> si usted no solicito este cambio solo ignore el correo. <br><br> https://bservicegonext.000webhostapp.com/Modificar/ModificacionContraseña/?p=".$urlencr."            Introdusca este TOKEN en los Campos de la Aplicacion: ".$Token;
                mail($correo, "Olvide Mi Contraseña",$mensaje, "From: WebService@000webhostapp.com");
            }
        }else{
            $R = array('Code' => 2, 'Estado' => "El correo indicado no esta relacionada con una cuenta");
            echo json_encode($R);
        }
       }else{
        $R = array('Code' => 4, 'Estado' => "Encontre un error al recibir el correo");
            echo json_encode($R);
       }
	}else{
        $R = array('Code' => 3, 'Estado' => "No Recibo ningun dato");
        echo json_encode($R);
    }