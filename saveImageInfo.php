<?php
require_once "Klase/Lice.php";
require_once "Klase/LiceDao.php";

$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];
$array = explode("/", $request);
$id = array_pop($array);
$id = intval($id);
$data = $_POST;
//$data = json_decode($data);
$liceDao = new \Dao\LiceDao();
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
}
header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');
$response = array();
$response['status'] = "Saved";
echo json_encode($response);
?>