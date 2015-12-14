<?php
namespace Dao;
use PDO as PDO;
class DAL{
    private $connection;
    private function __constructor(){}
    public static function Instanca(){
        return new DAL();
    }
    public function connect(){
        try{
            $connection = new PDO("mysql:dbname=face_recognition;host=localhost;charset=utf8", "root", "");
            $connection->exec("set names utf8");
            return $connection;
        }catch(PDOException $ex){
            throw new Exception("MYSQL greška:".$ex->getMessage());
        }
    }
}
?>