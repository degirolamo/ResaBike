<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 26.10.2017
 * Time: 08:55
 */

namespace ResaBike\App\Model;


use Resabike\Library\Entity\Arret;
use Resabike\Library\Entity\Reservation;

class ModelBook
{
    public function getAllBooks() {
        $bookManager = new Reservation();
        $books = $bookManager->getAllReservation();

        return $books;
    }

    public function deleteBook($id) {
        $bookManager = new Reservation();
        return $bookManager->deleteReservation($id);
    }

    public function getAllGoodBooks($idZone){

        // Liste de tous les arrets

        $arretManager = new Arret();
        $arrets = $arretManager->getAllArret();
        $arretGoodIdZone = [];

        // prendre que les arrêts de la même zone que l'utilisateur

        foreach ($arrets as $arret){
            if ($arret['idZone'] == $idZone)
                $arretGoodIdZone[count($arretGoodIdZone)] = $arret;

        }

        // prendre toutes les réservations

        $bookManager = new Reservation();
        $books = $bookManager->getAllReservation();
        $goodRerv = [];

        // Prendre que les réservations qui contiennent des arrêt de la zone en paramètre

        foreach ($books as $book) {

            foreach ($arretGoodIdZone as $arr){

                if($book['idStationDep'] == $arr['id']){
                    $goodRerv[count($goodRerv)]  = $book;
                }
            }
        }

        return $goodRerv;

    }

}