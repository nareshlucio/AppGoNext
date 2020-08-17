<?php  
	require_once 'BD.php';
	require_once 'ModeloUsuario.php';
	
	class Consultas extends BD
	{
		public $id_usuario;
		public $usuario;
		public $Correo;

		public function AllUsuarios(){
			$query = $this->conexionPDO()->prepare("SELECT * FROM usuarios");
			$query->execute();
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}

		public function verConductores(){
			$query = $this->conexionPDO()->prepare("SELECT * FROM actividad WHERE tipo_usuario = 'conductor'");
			$query->execute();
			if($query->rowCount()>0){
				foreach ($query as $key) {
					$s = array("id" =>$key["id_usuario"], "latitud"=> $key["cordenadas_latitud"], "longitud"=> $key["cordenadas_longitud"], "actividad"=>$key["activo"], "estado"=>$key["estado"]);
					$dato[]= $s;
				}
				$info['content'] = $dato;
				return $info;
			}else{
				$info = array('content' => 0);	
			}
		}

		public function verUsuarios(){
			$query = $this->conexionPDO()->prepare("SELECT * FROM actividad WHERE tipo_usuario = 'usuario'");
			$query->execute();
			if($query->rowCount()>0){
				foreach ($query as $key) {
					$s = array("id" =>$key["id_usuario"], "latitud"=> $key["cordenadas_latitud"], "longitud"=> $key["cordenadas_longitud"], "actividad"=>$key["activo"], "estado"=>$key["estado"]);
					$info = $s;
				}
				return $info;
			}else{
				$info = array('content' => 0);	
			}
		}
		public function actualizarCord($id, $latitud, $longitud, $tipo){
			$query = $this->conexionPDO()->prepare("UPDATE actividad SET cordenadas_longitud = :longitud, cordenadas_latitud = :latitud WHERE id_usuario= :id AND tipo_usuario= :tipo");
			if($query->execute(["id"=>$id ,"longitud"=>$longitud, "latitud"=>$longitud, "tipo"=> $tipo])){
				return true;
			}else{
				return false;	
			}
		}
		public function actualizarEstado($id, $tipo){
			$query = $this->conexionPDO()->prepare("UPDATE actividad SET activo = 1, estado = 'esperando' WHERE id_usuario= :id AND tipo_usuario = :tipo");
			if($query->execute(["id"=>$id, "tipo"=>$tipo])){
				return true;
			}else{
				return false;	
			}
		}

		public function registrarViaje($id_usu, $id_cond, $origen_latitud, $origen_longitud, $destino_latitud, $destino_longitud, $estado){
			$query = $this->conexionPDO()->prepare("INSERT INTO viajes()");
			if($query->execute(["id"=>$id])){
				return true;
			}else{
				return false;	
			}
		}

//-----------------------Cosas Para el Cambio de Contraseña---------------------------------
		public function ActualizarContra($con, $id){
			$sql = $this->conexionPDO()->prepare("UPDATE usuarios SET Password=:con WHERE Id_usuario=:id");
			if ($sql->execute(["con"=>$con, "id"=>$id]))
				return true;
			else
				return false;
		}

		public function StringAletorio($long){
			$universo = "0123456789abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ!#$%&()¡!°|*+-";
			$num_uni = strlen($universo);
			$stringnueva="";
			for ($i=0; $i < $long; $i++) { 
				$stringnueva .= $universo[rand(0, $num_uni-1)];
			}
			return $stringnueva;
		}
		
		public function ExistCorreo_recuperar($cor){
			$querycorr = $this->conexionPDO()->prepare("SELECT * FROM usuarios WHERE Correo = :cor");
			$querycorr->execute(['cor' =>$cor]);
			foreach ($querycorr as $rows) {
				if ($cor === $rows['Correo']){
					$this->id_usuario = $rows['Id_usuario'];
					$this->usuario = $rows['Alias'];
					$this->Correo = $rows['Correo'];
					$String_S = $this->StringAletorio(20);
					$str = $String_S.$this->usuario;
					$url = $str;
					return $url;
				}
			}
		}

		public function url_secreta_existe($url){
			$id = NULL;
			try {
				$sql = $this->conexionPDO()->prepare("SELECT * FROM recuperaciones WHERE url_secreta =:url AND estado ='No_Usado'");
					$sql->execute(['url' => $url]);
					$res = $sql->fetch();
				if(!empty($res))
					$id = $res['Id_usuario'];

			} catch(PDOException $ese){
				print 'ERROR'.$ese->getMessage();
			}
			return $id;
		}

		public function Token(){
			$universo = "0123456789";
			$num_uni = strlen($universo);
			$tokens="";
			for ($i=0; $i < 5; $i++) { 
				$tokens .= $universo[rand(0, $num_uni-1)];
			}
			return $tokens;
		}

		public function Borrar_Cambio($id_usuario){
			$sql = $this->conexionPDO()->prepare("UPDATE recuperaciones SET estado='Usado' WHERE Id_usuario=:ids");
			if($sql->execute(["ids"=>$id_usuario]))
				return true;
			else 
				return false;
		}
	}