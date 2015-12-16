<?php
namespace Dao;
require_once 'IDaoCrud.php';
require_once 'DAL.php';
class LiceDao implements IDaoCrud{
    private $konekcija;

    public function __construct(){
        try{
            $this->konekcija = DAL::Instanca()->connect();
        }
        catch(Exception $e){
            print $e->getMessage();
            die();
        }
    }

    public function create($valueObject)
    {
        try{
            $sql = "INSERT INTO lica ( idSlike, ugao, visina, ";
            $sql = $sql."sirina, godine, godineSigurnost, ";
            $sql = $sql."rasa, rasaSigurnost, brada, ";
            $sql = $sql."bradaSigurnost, spol, spolSigurnost, ";
            $sql = $sql."brkovi, brkoviSigurnost, naocare, ";
            $sql = $sql."naocareSigurnost) VALUES (".$valueObject->getIdSlike().", ";
            $sql = $sql."".$valueObject->getUgao().", ";
            $sql = $sql."".$valueObject->getVisina().", ";
            $sql = $sql."".$valueObject->getSirina().", ";
            $sql = $sql."".$valueObject->getGodine().", ";
            $sql = $sql."".$valueObject->getGodineSigurnost().", ";
            $sql = $sql."'".$valueObject->getRasa()."', ";
            $sql = $sql."".$valueObject->getRasaSigurnost().", ";
            $sql = $sql."'".$valueObject->getBrada()."', ";
            $sql = $sql."".$valueObject->getBradaSigurnost().", ";
            $sql = $sql."'".$valueObject->getSpol()."', ";
            $sql = $sql."".$valueObject->getSpolSigurnost().", ";
            $sql = $sql."'".$valueObject->getBrkovi()."', ";
            $sql = $sql."".$valueObject->getBrkoviSigurnost().", ";
            $sql = $sql."'".$valueObject->getNaocare()."', ";
            $sql = $sql."".$valueObject->getNaocareSigurnost().") ";
            //echo $sql;
            //die();
            $upit = $this->konekcija->prepare($sql);
            $upit->execute();
            return $this->konekcija->lastInsertId();
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function read($arg)
    {
        // TODO: Implement read() method.
    }

    public function update($arg)
    {
        // TODO: Implement update() method.
    }

    public function delete($arg)
    {
        // TODO: Implement delete() method.
    }

    public function getById($arg)
    {
        // TODO: Implement getById() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getByExample($name, $value)
    {
        // TODO: Implement getByExample() method.
    }
}
?>