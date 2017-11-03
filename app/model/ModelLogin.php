<?php
namespace ResaBike\App\Model;

use ResaBike\Library\Mvc\Model;
use ResaBike\Library\Database\DbConnect;


use Resabike\Library\Entity\Utilisateur;

class ModelLogin extends Model
{

    public function checkLogin($pseudo) {
        $userManager = new Utilisateur();

        $userList = $userManager->getAllUtilisateur();

        foreach ($userList as $user){

            if($user['pseudo'] = $pseudo)
                return $user['pass'];

        }

    }

    public function getAllUsers() {
        $userManager = new Utilisateur();
        $users = $userManager->getAllUtilisateur();

        return $users;
    }


}