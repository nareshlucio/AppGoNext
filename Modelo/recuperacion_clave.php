<?php
	include_once 'BD.php';

	class Recuperacion extends BD
	{
		public $id_usuario;
		public $url_secreta;
		public $token;
		public $fecha;

		public function __construct($id_usuario, $url_secreta, $token, $fecha)
		{
			$this->id_usuario = $id_usuario;
			$this->url_secreta = $url_secreta;
			$this->token = $token;
			$this->fecha = $fecha;
		}
		public function generar_peticion($conexion, $id_usuario, $url_secreta, $token){
			$peticion = false;
			if(isset($conexion)){
				try {
					$sql = $this->conexionPDO()->prepare("INSERT INTO recuperaciones(Id_usuario, url_secreta, token, estado, fecha) VALUES (:usuid, :url, :token, 'No_Usado', NOW())");
					if($sql->execute(["usuid"=>$id_usuario, "url"=>$url_secreta, "token"=>$token]))
						$peticion = true;

				} catch (PDOException $e) {
					print 'ERROR!!!'.$e->getMessage();
				}
			}
			return $peticion;
		}
	}