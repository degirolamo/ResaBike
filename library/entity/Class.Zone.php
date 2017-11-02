<?php
    namespace Resabike\Library\Entity;
	
	use \PDO;
	use resabike\library\database\DbConnect;
	
	class Zone{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addZone($nom){
			$conn = $this->conn;
			$sql="INSERT INTO zone(nom) VALUES (:nom)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":nom",$nom);
			$stat->execute();
			return $conn->lastInsertId();
		}
		public function updateZone($id,$nom){
			$conn = $this->conn;
			$sql="UPDATE zone SET nom=:nom WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);$stat->bindParam(":nom",$nom);
			$stat->execute();
		}
		public function deleteZone($id){
			$conn = $this->conn;
			$sql="DELETE FROM zone WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
		}
		public function getAllZone(){
			$conn = $this->conn;
			$sql="SELECT * FROM zone";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getZoneById($id){
			$conn = $this->conn;
			$sql="SELECT * FROM zone WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>