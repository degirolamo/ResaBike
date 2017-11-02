<?php
    namespace Resabike\Library\Entity;
	
	use \PDO;
	use resabike\library\database\DbConnect;
	
	class Arret{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addArret($nom){
			$conn = $this->conn;
			$sql="INSERT INTO arret(nom) VALUES (:nom)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":nom",$nom);
			$stat->execute();
		}
		public function updateArret($id,$nom){
			$conn = $this->conn;
			$sql="UPDATE arret SET nom=:nom WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);$stat->bindParam(":nom",$nom);
			$stat->execute();
		}
		public function deleteArret($id){
			$conn = $this->conn;
			$sql="DELETE FROM arret WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
		}
		public function getAllArret(){
			$conn = $this->conn;
			$sql="SELECT * FROM arret";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getArretById($id){
			$conn = $this->conn;
			$sql="SELECT * FROM arret WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>