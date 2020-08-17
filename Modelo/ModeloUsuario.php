<?php 
	include_once 'BD.php';
	Class User extends BD
	{
		public $id_usuario;
		public $apellidos;
		public $nombres;
		public $usuario;
		public $Correo;
		public $Telefono;
		public $Edad;

		public function getEdadUsu($fecha){
			$cumpleanos = new DateTime($fecha);
    		$hoy = new DateTime();
    		$edad = $hoy->diff($cumpleanos);
    		return $edad->y;
		}
//------------------------------Modelo Usuarios (Clientes)-----------------------------------------
		public function RegistroUsu($Ap, $nom, $Usu, $Corr, $pass, $tel, $edad){
			$encrypass= password_hash($pass, PASSWORD_BCRYPT);
			$query = $this->conexionPDO()->prepare("INSERT INTO usuarios(Apellidos, Nombre, Alias, Correo, Password, Telefono, Edad) VALUES (:Apes, :nom, :usu, :Corr, :pass, :tel, :ed)");
			if($query->execute(["Apes"=>$Ap, "nom"=>$nom, "usu"=>$Usu, "Corr"=>$Corr, "pass"=>$encrypass, "tel"=>$tel, "ed"=>$edad]))
				return true;
			else {
				return false;
			}
		}
		public function ExistUsu($usu){
			$corr = $usu;
			$query = $this->conexionPDO()->prepare("SELECT * FROM usuarios WHERE Alias = :usu OR Correo =:cor");
			$query->execute(['usu' =>$usu, 'cor'=>$corr]);
			foreach ($query as $rows) {
				if ($usu === $rows['Alias']){
					$datos = array("id" => $rows["id"], "nombre" => $rows["Nombre"], "apellidos" => $rows["Apellidos"], "usuario" => $rows["Alias"], "correo" => $rows["Correo"], "telefono" => $rows["Telefono"], "edad" => $rows["Edad"]);
					return $datos;
				}else if($corr === $rows['Correo']){
					$datos = array("id" => $rows["id"], "nombre" => $rows["Nombre"], "apellidos" => $rows["Apellidos"], "usuario" => $rows["Alias"], "correo" => $rows["Correo"], "telefono" => $rows["Telefono"], "edad" => $rows["Edad"]);
					return $datos;
				}
				else
					return false;
			}
		}

		public function registroActividad($id, $tipo){
			$query = $this->conexionPDO()->prepare("INSERT INTO actividad(id, tipo_usuario, cordenadas_longitud, cordenadas_latitud, activo, estado) VALUES (:id, :tip, :cordlong, :cordlat, :activ, :estad)");
			if($query->execute(["id"=>$id, "tip"=>$tipo, "cordlong"=>0, "cordlat"=>0, "activ"=>"0", "estad"=>"inactivo"]))
				return true;
			else {
				return false;
			}
		}
		public function actualizarInformacion($nom, $ape, $usuario, $correo, $telefono, $Edad){
			$query = $this->conexionPDO()->prepare("INSERT INTO actividad(id, tipo_usuario, cordenadas_longitud, cordenadas_latitud, activo, estado) VALUES (:id, :tip, :cordlong, :cordlat, :activ, :estad)");
			if($query->execute(["id"=>$id, "tip"=>$tipo, "cordlong"=>0, "cordlat"=>0, "activ"=>"0", "estad"=>"inactivo"]))
				return true;
			else {
				return false;
			}
		}
//-----------------------------Modelo Usuaros (Conductores)-----------------------------------------
		public function registroConductor($nom, $ape, $corr, $pass, $marca, $modelo, $matri, $tel){
			$passencry= password_hash($pass, PASSWORD_BCRYPT);
			$query = $this->conexionPDO()->prepare("INSERT INTO conductores(Nombre, apellidos, correo, password, marca, modelo, matricula, telefono) VALUES (:nom, :ape, :corr, :pass, :marc, :model, :matri, :tel)");
			if($query->execute(["nom"=>$nom, "ape"=>$ape, "corr"=>$corr, "pass"=>$passencry, "marc"=>$marca, "model"=>$modelo, "matri"=>$matri, "tel"=>$tel]))
				return true;
			else {
				return false;
			}
		}
		public function ExistConductor($usu){
			$query = $this->conexionPDO()->prepare("SELECT * FROM conductores WHERE correo = :usu");
			$query->execute(['usu' =>$usu]);
			foreach ($query as $rows) {
				if($usu === $rows['correo']){
					$datos = array("id" => $rows["id"], "nombre" => $rows["Nombre"], "apellidos" => $rows["apellidos"], "correo" => $rows["correo"], "marca" => $rows["marca"], "modelo" => $rows["modelo"], "matricula" => $rows["matricula"], "telefono" => $rows["telefono"]);
					return $datos;
				}
				else
					return false;
			}
		}
//---------------------------Comprueba si el Usuario escrito Existe en la BD----------------------
		public function ExistUsuario($usu, $pass){
			$corr = $usu;
			$query = $this->conexionPDO()->prepare("SELECT * FROM usuarios WHERE Alias = :usu OR Correo =:cor");
			$query->execute(['usu' =>$usu, 'cor'=>$corr]);
			foreach ($query as $rows) {
				if($usu === $rows['Correo'] && password_verify($pass, $rows['Password'])){
					return true;
				}
				if ($usu === $rows['Alias'] && password_verify($pass, $rows['Password'])){
					return true;
				}
				else{
					return false;
				}
			}
		}
		public function ExisteConductores($correo, $pass){
			$query = $this->conexionPDO()->prepare("SELECT correo, password FROM conductores WHERE correo =:cor");
			$query->execute(['cor'=>$correo]);
			foreach ($query as $rows) {
				if($correo === $rows['correo'] && password_verify($pass, $rows['password'])){
					return true;
				}
				else
					return false;
			}
		}
		
		public function getIdUsuario($usuario, $tipo_bus){
			switch ($tipo_bus) {
				case 1:
					$sql = $this->conexionPDO()->prepare("SELECT id FROM usuarios WHERE Alias = :usuario OR Correo = :cor");
					$sql->execute(['usuario' =>$usuario, 'cor'=>$usuario]);
					foreach ($sql as $row) {
						$id = $row['id'];
						if($id != null){
							return $id;
						}else
						return 0;
					}
				break;
				case 2:
					$sql = $this->conexionPDO()->prepare("SELECT id FROM conductores WHERE correo = :cor");
					$sql->execute(['cor'=>$usuarios]);
					foreach ($sql as $row) {
						$id = $row['id'];
						if($id != null){
							return $id;
						}else
						return 0;
					}
				break;
			}
		}
		public function setUsuario($usuarios){
			$cor = $usuarios;
			$sql = $this->conexionPDO()->prepare("SELECT * FROM usuarios WHERE Alias = :usuarios OR Correo = :cor");
			$sql->execute(['usuarios' =>$usuarios, 'cor'=>$cor]);
			foreach ($sql as $row) {
				$this->id_usuario = $row['Id_usuario'];
				$this->apellidos = $row['Apellidos'];
				$this->nombres = $row['Nombre'];
				$this->usuario = $row['Alias'];
				$this->Correo = $row['Correo'];
				$this->Telefono = $row['Telefono'];
				$this->Edad = $row['Edad'];
			}
		}
		public function prueba($correo){
			$query = $this->conexionPDO()->prepare("SELECT * FROM conductores WHERE correo =:cor");
			$query->execute(['cor'=>$correo]);
			foreach ($query as $rows) {
				if($correo === $rows['correo']){
					$datos = array("id" => $rows["id"], "nombre" => $rows["Nombre"], "apellidos" => $rows["apellidos"], "correo" => $rows["correo"], "contra"=>$rows["password"], "marca" => $rows["marca"], "modelo" => $rows["modelo"], "matricula" => $rows["matricula"], "telefono" => $rows["telefono"]);
					return $datos;
				}
				else
					return false;
			}
		}
	}