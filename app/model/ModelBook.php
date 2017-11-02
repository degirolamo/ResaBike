<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 26.10.2017
 * Time: 08:55
 */

namespace ResaBike\App\Model;


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

}