<?php
namespace Dao;
require_once 'IDaoCrud.php';
require_once 'Slika.php';
require_once 'DAL.php';
use \PDO as PDO;

class SlikaDao implements IDaoCrud{
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

    public function create($arg){
        try{
            $upit = $this->konekcija->prepare(
                "INSERT INTO slike (korisnikId, url, velicina, format, duzina, sirina) VALUES (:korisnikId, :url, :velicina, :format, :duzina, :sirina)"
            );
            $upit->execute(
                array(
                    ':korisnikId'=>$arg->getKorisnikId(),
                    ':url'=>$arg->getUrl(),
                    ':velicina'=>$arg->getVelicina(),
                    ':format'=>$arg->getFormat(),
                    ':duzina'=>$arg->getDuzina(),
                    ':sirina'=>$arg->getSirina()

                )
            );
            return $this->konekcija->lastInsertId();
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function read($arg){
        try{
            $upit = $this->konekcija->prepare(
                "SELECT * FROM slike WHERE idSlike=:idSlike"
            );
            $upit->execute(
                array(
                    ':idSlike'=>$arg->getIdSlike()
                )
            );
            $slika = new \Slika();
            if($upit->rowCount()>0){
                $data = $upit->fetch(PDO::FETCH_ASSOC);
                $slika->setIdSlike($data['idSlike']);
                $slika->setKorisnikId($data['korisnikId']);
                $slika->setUrl($data['url']);
                $slika->setVelicina($data['velicina']);
                $slika->setFormat($data['format']);
                $slika->setDuzina($data['duzina']);
                $slika->setSirina($data['sirina']);
            }
            return $slika;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function update($arg){
        try{
            $upit = $this->konekcija->prepare(
                "UPDATE slike SET korisnikId=:korisnikId, url=:url, velicina=:velicina, format=:format, duzina=:duzina, sirina=:sirina WHERE idSlike=:idSlike"
            );
            $upit->execute(
                array(
                    ':korisnikId'=>$arg->getKorisnikId(),
                    ':url'=>$arg->getUrl(),
                    ':velicina'=>$arg->getVelicina(),
                    ':format'=>$arg->getFormat(),
                    ':duzina'=>$arg->getDuzina(),
                    ':sirina'=>$arg->getSirina()
                )
            );
            return $arg;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function delete($arg){
        try{
            $upit = $this->konekcija->prepare(
                "DELETE FROM slike WHERE idSlike=:idSlike"
            );
            $upit->execute(
                array(
                    ':idslike'=>$arg->getIdSlike()
                )
            );
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getById($idSlike){
        try{
            $idSlike = intval($idSlike);
            $upit = $this->konekcija->prepare(
                "SELECT * FROM slike WHERE idSlike=:idSlike"
            );
            $upit->execute(
                array(
                    ':idslike'=>$idSlike
                )
            );
            $slika = new \Slika();
            if($upit->rowCount()>0){
                $data = $upit->fetch(PDO::FETCH_ASSOC);
                $slika->setIdSlike($data['idSlike']);
                $slika->setKorisnikId($data['korisnikId']);
                $slika->setUrl($data['url']);
                $slika->setVelicina($data['velicina']);
                $slika->setFormat($data['format']);
                $slika->setDuzina($data['duzina']);
                $slika->setSirina($data['sirina']);
            }
            return $slika;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    public function getAll(){
        try{
            $upit = $this->konekcija->prepare(
                "SELECT * FROM slike"
            );
            $upit->execute();
            $slike = array();
            if($upit->rowCount()>0){
                while ($row = $upit->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    $slika = new \slika();
                    $slika->setIdSlike($row['idSlike']);
                    $slika->setKorisnikId($row['korisnikId']);
                    $slika->setUrl($row['url']);
                    $slika->setVelicina($row['velicina']);
                    $slika->setFormat($row['format']);
                    $slika->setDuzina($row['duzina']);
                    $slika->setSirina($row['sirina']);
                    array_push($slike, $slika);
                }
            }
            return $slike;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }

//vjerujem da ova funkcija vraca slike na osnovu kolone: $name i vrijednosti koju ta kolona zadovoljava:value
    public function getByExample($name, $value){
        try{
            $sql = "SELECT * FROM slike WHERE $name=:value";
            $upit = $this->konekcija->prepare($sql);
            $upit->bindParam(':value', $value);
            $upit->execute();
            $slike = array();
            if($upit->rowCount()>0){
                while ($row = $upit->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    $slika = new \Slika();
                    $slika->setIdSlike($row['idSlike']);
                    $slika->setKorisnikId($row['korisnikId']);
                    $slika->setUrl($row['url']);
                    $slika->setVelicina($row['velicina']);
                    $slika->setFormat($row['format']);
                    $slika->setDuzina($row['duzina']);
                    $slika->setSirina($row['sirina']);
                    array_push($slike, $slika);
                }
            }
            return $slike;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}



?>