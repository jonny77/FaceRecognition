<?php
session_start();
require_once 'Klase/KorisnikDao.php';
require_once 'Klase/SlikaDao.php';
require_once 'Klase/Slika.php';
$logged = false;
$url=null;
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $korisnikId = $_SESSION['korisnikId'];
    $logged = true;
}

require_once "header.html";
if($logged) {
    require_once "meni.html";
    require_once "upload.html";

} else {
    require_once "login.html";
}
require_once "footer.html";
?>