<?php
namespace ResaBike\Library\Database;

use \PDO;

class DbConnect{

    public static function Get() {

        global $pdo;

        $db_host = "localhost";
        $db_name = "dbResabike";
        $db_user = "root";
        $db_pass = "";

        if($pdo == null) {
            try {
                $pdo = new PDO('mysql:host='.$db_host.';dbname='.$db_name.'', $db_user, $db_pass);
                $pdo->exec('SET NAMES utf8');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e){
                die('<div align="center">
                        <h1>Error</h1>
                        <h3>Can\'t connect to database</h3>
                    </div>');
            }
        }

        return $pdo;
    }
}