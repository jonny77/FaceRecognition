<?php
//Klase
require_once 'Klase/KorisnikDao.php';
require_once 'Klase/Korisnik.php';
//Funkcija zaglavlje (Postavke headera)
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}
//REST funkcije za manipulaciju podacima
function rest_get($request, $data) {
    $id = explode("/", $request);
    $id = array_pop($id);
    if(is_int($id)){
        $tip = array_pop($id);
        switch($tip){
            case 'fotografije':
                $rezultat = array();
                break;
        }
        print "{ \"$tip\": " . json_encode($rezultat) . "}";
    } else{
        $tip = $id;
        switch($tip){
            case 'fotografije':
                $rezultat = array();
                break;
        }
        print "{ \"".$tip."\": " . json_encode($rezultat) . "}";
    }
}
function rest_post($request, $data) {
    $uri = explode("/", $request);
    $tip = array_pop($uri);
    switch($tip){
        case 'login':
            $dao = new \Dao\KorisnikDao();
            $email = htmlentities($data['email']);
            $pass = htmlentities($data['password']);
            $hash = md5($pass);
            $logged =$dao->getLogin($email, $hash);



            if($logged){
                session_start();
                $usr = $dao->getByExample('email', $email);
                $usr = $usr[0];
                $username = $usr->getIme();
                $_SESSION['username'] = $username;

               $id= $usr->getId();
                $_SESSION['korisnikId'] = $id;

            }
            if(!$logged)
                rest_error("Pogrešni podaci.");
            return;
            break;
        case 'logout':
            session_start();
            if(isset($_SESSION['username']) && $_SESSION['username'] == $data['username']) {
                unset($_SESSION['username']);
                session_destroy();
            }else
                rest_error("Niste prijavljeni.");
            return;
            break;
        case 'register':
            session_start();
            try {
                $korisnik = new Korisnik();
                $ime = htmlentities($data['ime']);
                $prezime = htmlentities($data['prezime']);
                $korisnik->setIme($ime . " " . $prezime);
                $korisnik->setEmail(htmlentities($data['email']));
                $password = htmlentities($data['password']);
                $korisnik->setPassword(md5($password));
                $kdao = new \Dao\KorisnikDao();
                $kdao->create($korisnik);
                $username = $ime . " " . $prezime;
                $_SESSION['username'] = $username;
                $id=$korisnik->getId();
                $_SESSION['korisnikId']=$id;
            }catch (Exception $e){
                rest_error($e->getMessage());
            }
            break;
    }
}
function rest_delete($request) {

}
function rest_put($request, $data) {
}
function rest_error($error) {
    $json = "{ \"Greška\": ".json_encode($error)."}";
    header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
    print $json;
}

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars;
        rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST;
        rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET;
        rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>