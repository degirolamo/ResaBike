<?php
    namespace Resabike\Library\Entity;
	
	use \PDO;
	use resabike\library\database\DbConnect;
	
		class Remorque{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addRemorque($idZone,$nbPlaces,$prise){
			$conn = $this->conn;
			$sql="INSERT INTO remorque(idZone,nbPlaces,prise) VALUES (:idZone,:nbPlaces,:prise)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idZone",$idZone);$stat->bindParam(":nbPlaces",$nbPlaces);$stat->bindParam(":prise",$prise);
			$stat->execute();
		}
		public function updateRemorque($id,$idZone,$nbPlaces,$prise){
			$conn = $this->conn;
			$sql="UPDATE remorque SET idZone=:idZone,nbPlaces=:nbPlaces,prise=:prise WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);$stat->bindParam(":idZone",$idZone);$stat->bindParam(":nbPlaces",$nbPlaces);$stat->bindParam(":prise",$prise);
			$stat->execute();
		}
		public function deleteRemorque($id){
			$conn = $this->conn;
			$sql="DELETE FROM remorque WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
		}
		public function getAllRemorque(){
			$conn = $this->conn;
			$sql="SELECT * FROM remorque";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getRemorqueById($id){
			$conn = $this->conn;
			$sql="SELECT * FROM remorque WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>