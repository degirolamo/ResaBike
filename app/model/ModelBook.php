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
    /**
     * Get all books
     * @return array
     */
    public function getAllBooks()
    {
        $bookManager = new Reservation();
        $books = $bookManager->getAllReservation();

        return $books;
    }

    /**
     * Delete a book
     * @param $id
     */
    public function deleteBook($id)
    {
        $bookManager = new Reservation();
        return $bookManager->deleteReservation($id);
    }

    /**
     * Get all books by idzone
     * @param $idZone
     * @return array
     */
    public function getAllGoodBooks($idZone)
    {

        // Get all stations

        $arretManager = new Arret();
        $arrets = $arretManager->getAllArret();
        $arretGoodIdZone = [];

        // Get only the stations by idzone

        foreach ($arrets as $arret) {
            if ($arret['idZone'] == $idZone)
                $arretGoodIdZone[count($arretGoodIdZone)] = $arret;

        }

        // Get all books

        $bookManager = new Reservation();
        $books = $bookManager->getAllReservation();
        $goodRerv = [];

        // get only the books by idstations

        foreach ($books as $book) {

            foreach ($arretGoodIdZone as $arr) {

                if ($book['idStationDep'] == $arr['id']) {
                    $goodRerv[count($goodRerv)] = $book;
                }
            }
        }

        return $goodRerv;

    }

}