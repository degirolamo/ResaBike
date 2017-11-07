<?php

namespace Resabike\Library\Entity;

use \PDO;
use resabike\library\database\DbConnect;

class Reservation
{
    var $conn;

    public function __construct()
    {
        $this->conn = DbConnect::Get('Connection');
    }

    public function addReservation($idStartStation, $idEndStation, $email, $nbVelos, $dateDepart, $confirme)
    {
        $conn = $this->conn;
        $sql = "INSERT INTO reservation VALUES (NULL, :idStartStation, :idEndStation, :email, :nbVelos, :dateDepart,:confirme)";
        $stat = $conn->prepare($sql);
        $stat->bindParam(":idStartStation", $idStartStation);
        $stat->bindParam(":idEndStation", $idEndStation);
        $stat->bindParam(":email", $email);
        $stat->bindParam(":nbVelos", $nbVelos);
        $stat->bindParam(":dateDepart", $dateDepart);
        $stat->bindParam(":confirme", $confirme);
        $stat->execute();
    }

    public function deleteReservation($id)
    {
        $conn = $this->conn;
        $sql = "DELETE FROM reservation WHERE id=:id";
        $stat = $conn->prepare($sql);
        $stat->bindParam(":id", $id);
        $stat->execute();
    }

    public function getAllReservation()
    {
        $conn = $this->conn;
        $sql = "SELECT * FROM reservation";
        return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservationById($id)
    {
        $conn = $this->conn;
        $sql = "SELECT * FROM reservation WHERE id=:id";
        $stat = $conn->prepare($sql);
        $stat->bindParam(":id", $id);
        $stat->execute();
        return $stat->fetch(PDO::FETCH_LAZY);
    }
}

?>