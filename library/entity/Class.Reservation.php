<?php
    namespace Resabike\Library\Entity;
	
	use \PDO;
	use resabike\library\database\DbConnect;
	
		class Reservation{
		var $conn;
		public function __construct(){
			$this->conn=DbConnect::Get('Connection');
		}
		public function addReservation($idLigne,$nom,$prenom,$nomGroupe,$email,$tel,$remarque,$dateCreation,$nbVelos,$dateDepart,$confirme){
			$conn = $this->conn;
			$sql="INSERT INTO reservation(idLigne,nom,prenom,nomGroupe,email,tel,remarque,dateCreation,nbVelos,dateDepart,confirme) VALUES (:idLigne,:nom,:prenom,:nomGroupe,:email,:tel,:remarque,:dateCreation,:nbVelos,:dateDepart,:confirme)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idLigne",$idLigne);$stat->bindParam(":nom",$nom);$stat->bindParam(":prenom",$prenom);$stat->bindParam(":nomGroupe",$nomGroupe);$stat->bindParam(":email",$email);$stat->bindParam(":tel",$tel);$stat->bindParam(":remarque",$remarque);$stat->bindParam(":dateCreation",$dateCreation);$stat->bindParam(":nbVelos",$nbVelos);$stat->bindParam(":dateDepart",$dateDepart);$stat->bindParam(":confirme",$confirme);
			$stat->execute();
		}
		public function updateReservation($id,$idLigne,$nom,$prenom,$nomGroupe,$email,$tel,$remarque,$dateCreation,$nbVelos,$dateDepart,$confirme){
			$conn = $this->conn;
			$sql="UPDATE reservation SET idLigne=:idLigne,nom=:nom,prenom=:prenom,nomGroupe=:nomGroupe,email=:email,tel=:tel,remarque=:remarque,dateCreation=:dateCreation,nbVelos=:nbVelos,dateDepart=:dateDepart,confirme=:confirme WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);$stat->bindParam(":idLigne",$idLigne);$stat->bindParam(":nom",$nom);$stat->bindParam(":prenom",$prenom);$stat->bindParam(":nomGroupe",$nomGroupe);$stat->bindParam(":email",$email);$stat->bindParam(":tel",$tel);$stat->bindParam(":remarque",$remarque);$stat->bindParam(":dateCreation",$dateCreation);$stat->bindParam(":nbVelos",$nbVelos);$stat->bindParam(":dateDepart",$dateDepart);$stat->bindParam(":confirme",$confirme);
			$stat->execute();
		}
		public function deleteReservation($id){
			$conn = $this->conn;
			$sql="DELETE FROM reservation WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
		}
		public function getAllReservation(){
			$conn = $this->conn;
			$sql="SELECT * FROM reservation";
			return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getReservationById($id){
			$conn = $this->conn;
			$sql="SELECT * FROM reservation WHERE id=:id";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":id",$id);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>