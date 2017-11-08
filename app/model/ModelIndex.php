<?php
namespace ResaBike\App\Model;

use Resabike\Library\Entity\Reservation;
use ResaBike\Library\Mvc\Model;
use ResaBike\Library\Entity\Arret;

class ModelIndex extends Model{
    public function getStations($name) {
        $arretManager = new Arret();
        $stations = $arretManager->getArretsByName($name);
        $tabStations = [];

        foreach($stations as $station) {
            array_push($tabStations, $station);
        }

        return $tabStations;
    }

    public function getStationByName($name) {
        $arretManager = new Arret();
        $stations = $arretManager->getAllArret();




        foreach ($stations as $station) {
            if($station['nom'] == $name)
                return $station;
        }

    }

    public function addBook($idStartStation, $idEndStation, $email, $phone,  $nbVelos, $dateDepart, $confirme) {
        $reservationManager = new Reservation();

        return $reservationManager->addReservation($idStartStation, $idEndStation, $email,$phone, $nbVelos, $dateDepart, $confirme);
    }

    public function deleteBook($id) {
        $bookManager = new Reservation();
        return $bookManager->deleteReservation($id);
    }


}