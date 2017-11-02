<?php
namespace ResaBike\App\Model;

use ResaBike\Library\Mvc\Model;
use ResaBike\Library\Database\DbConnect;

class ModelIndex extends Model{
    public function getCoucou(){
        return 'coucou';
    }

    public function getUser($id){
        $db = DbConnect::Get();
        //$stmt = 'select -----
        $user = new User($stmt);
        return $user;
    }


}