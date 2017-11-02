<?php
namespace ResaBike\App\Model;

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


}