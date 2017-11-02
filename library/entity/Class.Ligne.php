<?php
    namespace Resabike\Library\Entity;
	
	use \PDO;
	use resabike\library\database\DbConnect;
	
	class Ligne{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addLigne($idGareDep,$idGareFin,$idZone){
			$conn = $this->conn;
			$sql="INSERT INTO ligne(idGareDep,idGareFin,idZone) VALUES (:idGareDep,:idGareFin,:idZone)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idGareDep",$idGareDep);$stat->bindParam(":idGareFin",$idGareFin);$stat->bindParam(":idZone",$idZone);
			$stat->execute();
		}
		public function updateLigne($id,$idGareDep,$idGareFin,$idZone){
			$conn = $this->conn;
			$sql="UPDATE ligne SET idGareDep=:idGareDep,idGareFin=:idGareFin,idZone=:idZone WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);$stat->bindParam(":idGareDep",$idGareDep);$stat->bindParam(":idGareFin",$idGareFin);$stat->bindParam(":idZone",$idZone);
			$stat->execute();
		}
		public function deleteLigne($id){
			$conn = $this->conn;
			$sql="DELETE FROM ligne WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
		}
		public function getAllLigne(){
			$conn = $this->conn;
			$sql="SELECT * FROM ligne";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getLigneById($id){
			$conn = $this->conn;
			$sql="SELECT * FROM ligne WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>