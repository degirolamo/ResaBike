<?php
    namespace ResaBike\Library\Entity;
	
	use \PDO;
	use ResaBike\Library\Database\DbConnect;

	class Utilisateur{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addUtilisateur($idRole,$idZone,$pseudo,$pass,$email){
			$conn = $this->conn;
			$sql="INSERT INTO utilisateur(idRole,idZone,pseudo,pass,email) VALUES (:idRole,:idZone,:pseudo,:pass,:email)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idRole",$idRole);$stat->bindParam(":idZone",$idZone);$stat->bindParam(":pseudo",$pseudo);$stat->bindParam(":pass",$pass);$stat->bindParam(":email",$email);
			$stat->execute();
		}
		public function updateUtilisateur($id,$idRole,$idZone,$pseudo,$pass,$email){
			$conn = $this->conn;
			$sql="UPDATE utilisateur SET idRole=:idRole,idZone=:idZone,pseudo=:pseudo,pass=:pass,email=:email WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);$stat->bindParam(":idRole",$idRole);$stat->bindParam(":idZone",$idZone);$stat->bindParam(":pseudo",$pseudo);$stat->bindParam(":pass",$pass);$stat->bindParam(":email",$email);
			$stat->execute();
		}
		public function deleteUtilisateur($id){
			$conn = $this->conn;
			$sql="DELETE FROM utilisateur WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
		}
		public function getAllUtilisateur(){
			$conn = $this->conn;
			$sql="SELECT * FROM utilisateur";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getUtilisateurById($id){
			$conn = $this->conn;
			$sql="SELECT * FROM utilisateur WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>