<?php
    namespace Resabike\Library\Entity;
	
	use \PDO;
	use resabike\library\database\DbConnect;
	
	class Role{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addRole($nom){
			$conn = $this->conn;
			$sql="INSERT INTO role(nom) VALUES (:nom)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":nom",$nom);
			$stat->execute();
		}
		public function updateRole($id,$nom){
			$conn = $this->conn;
			$sql="UPDATE role SET nom=:nom WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);$stat->bindParam(":nom",$nom);
			$stat->execute();
		}
		public function deleteRole($id){
			$conn = $this->conn;
			$sql="DELETE FROM role WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
		}
		public function getAllRole(){
			$conn = $this->conn;
			$sql="SELECT * FROM role";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getRoleById($id){
			$conn = $this->conn;
			$sql="SELECT * FROM role WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>