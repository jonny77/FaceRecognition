<?php
class Korisnik{
    private $idKorisnik;
    private $ime;
    private $email;
    private $password;

    public function __construct(){
        $this->ime = null;
        $this->email = null;
    }
    public function getId(){
        return $this->idKorisnik;
    }
    public  function  setId($id){
        $this->idKorisnik = $id;
    }
    public function getIme(){
        return $this->ime;
    }
    public function setIme($ime){
        $this->ime = $ime;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }
}
?>