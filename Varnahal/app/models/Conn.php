<?php
namespace App\models;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}

use Exception;
use PDO;

class Conn{
    private string $db = "mysql";
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $dbname = "varnahal";
    public object $connect;

    protected function connect(){
        try {
            $this->connect = new PDO($this->db.':host'.$this->host.';dbname='.$this->dbname,$this->user,$this->pass);
            return $this->connect;
        } catch (Exception $e) {
            die('deu ruim menó tenta fazer dnv senão chama no zap (19)9 9868-2213');
        }

    }



}


?>