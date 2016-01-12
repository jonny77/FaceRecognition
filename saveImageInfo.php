<?php
require_once "Klase/Lice.php";
require_once "Klase/LiceDao.php";
require_once "Klase/Slika.php";
require_once "Klase/SlikaDao.php";

$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];
$array = explode("/", $request);
$id = array_pop($array);
$id = intval($id);
$data = $_POST;
//$data = json_decode($data);
$liceDao = new \Dao\LiceDao();
$lica = array();
foreach ($data['faces'] as $face) {
    $lice = new Lice();
    $lice->setUgao($face['angle']);
    $lice->setSirina($face['width']);
    $lice->setVisina($face['height']);
    $lice->setIdSlike($id);
    foreach($face['tags'] as $tag){
        switch($tag['name']){
            case 'age':
                $lice->setGodine($tag['value']);
                $lice->setGodineSigurnost($tag['confidence']);
                break;
            case 'beard':
                $lice->setBrada($tag['value']);
                $lice->setBradaSigurnost($tag['confidence']);
                break;
            case 'gender':
                $lice->setSpol($tag['value']);
                $lice->setSpolSigurnost($tag['confidence']);
                break;
            case 'glasses':
                $lice->setNaocare($tag['value']);
                $lice->setNaocareSigurnost($tag['confidence']);
                break;
            case 'mustache':
                $lice->setBrkovi($tag['value']);
                $lice->setBrkoviSigurnost($tag['confidence']);
                break;
            case 'race':
                $lice->setRasa($tag['value']);
                $lice->setRasaSigurnost($tag['confidence']);
                break;
        }
    }
    $liceDao->create($lice);
    array_push($lica, $lice);
}
header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');

$slikaDao = new \Dao\SlikaDao();
$slike = array();
foreach($lica as $item){
    $slike = $slikaDao->getFaces($item->getGodine(),
                                $item->getRasa(),
                                $item->getBrada(),
                                $item->getSpol(),
                                $item->getBrkovi(),
                                $item->getNaocare()
                            );
}
//Budući da betaface api treba stvarni url slike, to lokalno nije moguće
//testirati, pa navedeni upit vraća prazan result set. U kodu ispod je
//učitano 5 slika iz baze zbog demonstracije prikaza slika na stranici
$slike = $slikaDao->getAll();
$slike = array_slice($slike, 0, 5);
$response = array();
foreach($slike as $pic){
    $tmp['id'] = $pic->getIdSlike();
    $tmp['url'] = $pic->getUrl();
    array_push($response, $tmp);
}
echo json_encode($response);
?>