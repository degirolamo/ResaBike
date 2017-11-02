<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 25.10.2017
 * Time: 17:27
 */

namespace ResaBike\App\Model;


use Resabike\Library\Entity\Role;
use Resabike\Library\Entity\Zone;
use Resabike\Library\Entity\Arret;

class ModelZone
{
    public function getAllZones() {
        $zoneManager = new Zone();
        $zones = $zoneManager->getAllZone();

        return $zones;
    }

    public function deleteZone($id) {
        $zoneManager = new Zone();
        return $zoneManager->deleteZone($id);
    }

    public function deleteStations($id) {
        $arretManager = new Arret();
        $arrets = $arretManager->getAllArret();

        foreach($arrets as $arret) {
            if($arret['idZone'] == $id)
                $arretManager->deleteArret($arret['id']);
        }
    }

    public function addZone($nom) {
        $zoneManager = new Zone();
        return $zoneManager->addZone($nom);
    }

    public function editZone($id){
        $zoneManager = new Zone();
        $zoneEdited = $zoneManager->getZoneById($id);



        return $zoneEdited;
    }

    public function updateZone($id,$nom) {

        $zoneManager = new Zone();
        return $zoneManager->updateZone($id,$nom);


    }

    public function existsStation($name, $idZone) {
        $arretManager = new Arret();
        $stations = $arretManager->getAllArret();

        foreach($stations as $station) {
            if($name == $station['nom'] && $idZone == $station['idZone'])
                return true;
        }

        return false;
    }

    public function addStation($name, $idZone) {
        $arretManager = new Arret();
        if(!$this->existsStation($name, $idZone)) {
            $arretManager->addArret($name, $idZone);
            return true;
        }
        return false;
    }



}
