<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 25.10.2017
 * Time: 18:22
 */

namespace ResaBike\App\Model;

use ResaBike\Library\Entity\Utilisateur;
use ResaBike\Library\Entity\Role;
use ResaBike\Library\Entity\Zone;

class ModelUsers
{
    public function getAllUsers() {
        $userManager = new Utilisateur();
        $users = $userManager->getAllUtilisateur();
        $roleManager = new Role();
        $zoneManager = new Zone();

        foreach($users as &$user) {
            $role = $roleManager->getRoleById($user['idRole']);
            $zone = $zoneManager->getZoneById($user['idZone']);
            $user['roleName'] = $role['nom'];
            $user['zoneName'] = $zone['nom'];
        }
        return $users;
    }

    public function deleteUser($id) {
        $userManager = new Utilisateur();

        return $userManager->deleteUtilisateur($id);
    }

    public function addUser($idRole, $idZone, $pseudo, $pass, $email) {
        $userManager = new Utilisateur();
        return $userManager->addUtilisateur($idRole, $idZone, $pseudo, $pass, $email);
    }

    public function getAllRoles() {
        $roleManager = new Role();
        $roles = $roleManager->getAllRole();

        return $roles;
    }

    public function editUser($id) {

        $userManager = new Utilisateur();
        $userEdited = $userManager->getUtilisateurById($id);

        return $userEdited;

    }

    public function getAllZones() {
        $zoneManager = new Zone();
        $zones = $zoneManager->getAllZone();

        return $zones;

    }

    public function updateUser($id,$idRole,$idZone,$pseudo,$pass,$email) {

        $userManager = new Utilisateur();
        return $userManager->updateUtilisateur($id,$idRole,$idZone,$pseudo,$pass,$email);


    }

}