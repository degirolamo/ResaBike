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
    /**
     * get all zones
     * @return array
     */
    public function getAllZones()
    {
        $zoneManager = new Zone();
        $zones = $zoneManager->getAllZone();

        return $zones;
    }

    /**
     * get all zone by idzone
     * @param $idZone
     * @return array
     */
    public function getAllGoodZones($idZone)
    {
        $zoneManager = new Zone();
        $zones = $zoneManager->getAllZone();
        $zoneGoodIdZone = [];
// Get zones with the good iduser
        foreach ($zones as $zone) {
            if ($zone['id'] == $idZone)
                $zoneGoodIdZone[count($zoneGoodIdZone)] = $zone;

        }


        return $zoneGoodIdZone;
    }

    /**
     * delete a zone
     * @param $id
     */
    public function deleteZone($id)
    {
        $zoneManager = new Zone();
        return $zoneManager->deleteZone($id);
    }

    /**
     * delete all stations by idzone
     * @param $id
     */
    public function deleteStations($id)
    {
        $arretManager = new Arret();
        $arrets = $arretManager->getAllArret();

        foreach ($arrets as $arret) {
            if ($arret['idZone'] == $id)
                $arretManager->deleteArret($arret['id']);
        }
    }

    /**
     * add a zone
     * @param $nom
     * @return string
     */
    public function addZone($nom)
    {
        $zoneManager = new Zone();
        return $zoneManager->addZone($nom);
    }

    /**
     * edit a zone
     * @param $id
     * @return mixed
     */
    public function editZone($id)
    {
        $zoneManager = new Zone();
        $zoneEdited = $zoneManager->getZoneById($id);


        return $zoneEdited;
    }

    /**
     * update a zone
     * @param $id
     * @param $nom
     */
    public function updateZone($id, $nom)
    {

        $zoneManager = new Zone();
        return $zoneManager->updateZone($id, $nom);


    }

    /**
     * return true if the station is already in the zone
     * @param $name
     * @param $idZone
     * @return bool
     */
    public function existsStation($name, $idZone)
    {
        $arretManager = new Arret();
        $stations = $arretManager->getAllArret();

        foreach ($stations as $station) {
            if ($name == $station['nom'] && $idZone == $station['idZone'])
                return true;
        }

        return false;
    }

    /**
     * add a station in a zone
     * @param $name
     * @param $idZone
     * @return bool
     */
    public function addStation($name, $idZone)
    {
        $arretManager = new Arret();
        if (!$this->existsStation($name, $idZone)) {
            $arretManager->addArret($name, $idZone);
            return true;
        }
        return false;
    }


}
