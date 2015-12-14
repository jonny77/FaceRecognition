<?php
namespace Dao;
require_once 'IDaoCrud.php';
require_once 'Korisnik.php';
require_once 'DAL.php';
use \PDO as PDO;
class KorisnikDao implements IDaoCrud {
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
                "INSERT INTO korisnici (ime, email, password) VALUES (:ime, :email, :password)"
            );
            $upit->execute(
                array(
                    ':ime'=>$arg->getIme(),
                    ':email'=>$arg->getEmail(),
                    ':password'=>$arg->getPassword()
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
                "SELECT * FROM korisnici WHERE idKorisnik=:id"
            );
            $upit->execute(
                array(
                    ':id'=>$arg->getId()
                )
            );
            $korisnik = new \Korisnik();
            if($upit->rowCount()>0){
                $data = $upit->fetch(PDO::FETCH_ASSOC);
                $korisnik->setId($data['idKorisnik']);
                $korisnik->setIme($data['ime']);
                $korisnik->setEmail($data['email']);
                $korisnik->setPassword($data['password']);
            }
            return $korisnik;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    public function update($arg){
        try{
            $upit = $this->konekcija->prepare(
                "UPDATE korisnici SET ime=:ime, email=:email, password=:password WHERE idKorisnika=:id"
            );
            $upit->execute(
                array(
                    ':id'=>$arg->getId(),
                    ':ime'=>$arg->getIme(),
                    ':email'=>$arg->getEmail(),
                    ':password'=>$arg->getPassword()
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
                "DELETE FROM korisnici WHERE idKorisnika=:id"
            );
            $upit->execute(
                array(
                    ':id'=>$arg->getId()
                )
            );
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    public function getById($id){
        try{
            $id = intval($id);
            $upit = $this->konekcija->prepare(
                "SELECT * FROM korisnici WHERE idKorisnik=:id"
            );
            $upit->execute(
                array(
                    ':id'=>$id
                )
            );
            $korisnik = new \Korisnik();
            if($upit->rowCount()>0){
                $data = $upit->fetch(PDO::FETCH_ASSOC);
                $korisnik->setId($data['idKorisnik']);
                $korisnik->setIme($data['ime']);
                $korisnik->setEmail($data['email']);
                $korisnik->setPassword($data['password']);
            }
            return $korisnik;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    public function getAll(){
        try{
            $upit = $this->konekcija->prepare(
                "SELECT * FROM korisnici"
            );
            $upit->execute();
            $korisnici = array();
            if($upit->rowCount()>0){
                while ($row = $upit->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    $korisnik = new \Korisnik();
                    $korisnik->setId($row['idKorisnik']);
                    $korisnik->setIme($row['ime']);
                    $korisnik->setEmail($row['email']);
                    $korisnik->setPassword($row['password']);
                    array_push($korisnici, $korisnik);
                }
            }
            return $korisnici;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    public function getByExample($name, $value){
        try{
            $sql = "SELECT * FROM korisnici WHERE $name=:value";
            $upit = $this->konekcija->prepare($sql);
            $upit->bindParam(':value', $value);
            $upit->execute();
            $korisnici = array();
            if($upit->rowCount()>0){
                while ($row = $upit->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    $korisnik = new \Korisnik();
                    $korisnik->setId($row['idKorisnik']);
                    $korisnik->setIme($row['ime']);
                    $korisnik->setEmail($row['email']);
                    $korisnik->setPassword($row['password']);
                    array_push($korisnici, $korisnik);
                }
            }
            return $korisnici;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    public function getLogin($email, $pass){
        try{
            $upit = $this->konekcija->prepare(
                "SELECT * FROM korisnici WHERE email=:email AND password=:password"
            );
            $upit->bindParam(':email', $email, PDO::PARAM_STR);
            $upit->bindParam(':password', $pass, PDO::PARAM_STR);
            $upit->execute();
            return $upit->rowCount()>0;
        } catch(\PDOException $e){

        }
    }
}
