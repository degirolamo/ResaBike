<?php
    namespace Resabike\Library\Entity;
	
	use \PDO;
	use resabike\library\database\DbConnect;
	
	class Stop{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addStop($idLigne,$idArret){
			$conn = $this->conn;
			$sql="INSERT INTO stop(idLigne,idArret) VALUES (:idLigne,:idArret)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idLigne",$idLigne);$stat->bindParam(":idArret",$idArret);
			$stat->execute();
		}
		public function updateStop($idLigne,$idArret){
			$conn = $this->conn;
			$sql="UPDATE stop SET idLigne=:idLigne,idArret=:idArret WHERE ";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idLigne",$idLigne);$stat->bindParam(":idArret",$idArret);
			$stat->execute();
		}
		public function deleteStop(){
			$conn = $this->conn;
			$sql="DELETE FROM stop WHERE ";
			$stat = $conn->prepare($sql);
			
			$stat->execute();
		}
		public function getAllStop(){
			$conn = $this->conn;
			$sql="SELECT * FROM stop";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getStopById(){
			$conn = $this->conn;
			$sql="SELECT * FROM stop WHERE ";
			$stat = $conn->prepare($sql);
			
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>