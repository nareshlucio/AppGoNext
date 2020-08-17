<?php
	/*function conexion(){
		$result = new mysqli('mysql.webcindario.com', 'apisnaresh', 'apisnaresh', 'api'); 
   		if (!$result)
     		throw new Exception('<h1>No se Pudo Conectar con la BD</h1>');
   		else
     		return $result;
	}*/
	class BD
	{
		public function conexionPDO(){
			$host = 'mysql.webcindario.com';
			$db = 'deezer_api';
			$user = 'deezer_api';
			$pass ='miheroe$99';
			$charset = 'utf8_spanish_ci';
			try {
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
						PDO::ATTR_EMULATE_PREPARES => false, 
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			];
    		$pdo = new PDO('mysql:host='.$host.';dbname='.$db.'', $user, $pass, $options);
    		return $pdo;
			} catch (PDOException $e) {
    			echo 'Falló la conexión: ' . $e->getMessage();
    			die();
			}
		}
	}