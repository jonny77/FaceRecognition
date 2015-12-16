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
    $lice->setGodine($face['tags'][0]['value']);
    $lice->setGodineSigurnost($face['tags'][0]['confidence']);
    $lice->setBrada($face['tags'][1]['value']);
    $lice->setBradaSigurnost($face['tags'][1]['confidence']);
    $lice->setSpol($face['tags'][2]['value']);
    $lice->setSpolSigurnost($face['tags'][2]['confidence']);
    $lice->setNaocare($face['tags'][3]['value']);
    $lice->setNaocareSigurnost($face['tags'][3]['confidence']);
    $lice->setBrkovi($face['tags'][4]['value']);
    $lice->setBrkoviSigurnost($face['tags'][4]['confidence']);
    $lice->setRasa($face['tags'][5]['value']);
    $lice->setRasaSigurnost($face['tags'][5]['confidence']);
    $lice->setUgao($face['angle']);
    $lice->setSirina($face['width']);
    $lice->setVisina($face['height']);
    $lice->setIdSlike($id);
    $liceDao->create($lice);
}
header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');
$response = array();
$response['status'] = "Saved";
echo json_encode($response);
?>