<?php
session_start();
require_once 'Klase/KorisnikDao.php';
require_once 'Klase/SlikaDao.php';
require_once 'Klase/Slika.php';
$logged = false;
$url=null;
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $korisnikId=$_SESSION['korisnikId'];
    $logged = true;
}elseif(isset($_POST['registracija'])){
    $korisnik = new \Dao\Korisnik();
    $ime = htmlentities($_POST['ime']);
    $prezime = htmlentities($_POST['prezime']);
    $korisnik->setIme($ime." ".$prezime);
    $korisnik->setEmail(htmlentities($_POST['email']));
    $password = htmlentities($_POST['password']);
    $korisnik->setPassword(md5($password));
    $kdao = new \Dao\KorisnikDao();
    $kdao->create($korisnik);
    $logged = true;
    $username = $ime." ".$prezime;

    $_SESSION['username'] = $username;
    $id=$korisnik->getId();
    $_SESSION['korisnikId'] = $id;
}
if(isset($_POST['file']))
{
    $slika= new Slika();
    $sdao= new \Dao\SlikaDao();
    $slike=$sdao->getAll();
    $slika= end($slike);
    $url=$slika->getUrl();

}



require_once "header.html";

if($logged) {
    require_once "meni.html";
    require_once "upload.html";

} else
    require_once "login.html";
require_once "footer.html";
?>