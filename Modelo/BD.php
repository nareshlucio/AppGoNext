<?php
	class BD
	{
		public function conexionPDO(){
			$host = 'localhost';
			$db = 'app';
			$user = 'root';
			$pass ='';
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