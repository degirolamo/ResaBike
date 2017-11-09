<?php
namespace ResaBike\App\Model;

use Resabike\Library\Entity\Reservation;
use ResaBike\Library\Mvc\Model;
use ResaBike\Library\Entity\Arret;

class ModelIndex extends Model{

    /**
     * Get stations by name
     * @param $name
     * @return array
     */
    public function getStations($name) {
        $arretManager = new Arret();
        $stations = $arretManager->getArretsByName($name);
        $tabStations = [];

        foreach($stations as $station) {
            array_push($tabStations, $station);
        }

        return $tabStations;
    }

    /**
     * Get station by name
     * @param $name
     * @return mixed
     */
    public function getStationByName($name) {
        $arretManager = new Arret();
        $stations = $arretManager->getAllArret();

        foreach ($stations as $station) {
            if($station['nom'] == $name)
                return $station;
        }

    }

    /**
     * Add a book
     * @param $idStartStation
     * @param $idEndStation
     * @param $email
     * @param $phone
     * @param $nbVelos
     * @param $dateDepart
     * @return string
     */
    public function addBook($idStartStation, $idEndStation, $email, $phone, $nbVelos, $dateDepart) {
        $reservationManager = new Reservation();

        return $reservationManager->addReservation($idStartStation, $idEndStation, $email,$phone, $nbVelos, $dateDepart);
    }

    /**
     * delete a book
     * @param $id
     */
    public function deleteBook($id) {
        $bookManager = new Reservation();
        return $bookManager->deleteReservation($id);
    }


}