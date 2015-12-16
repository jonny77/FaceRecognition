<?php
//Klase
require_once 'Klase/KorisnikDao.php';
require_once 'Klase/Korisnik.php';
require_once 'Klase/SlikaDao.php';
require_once 'Klase/Slika.php';

if(isset($_FILES["file"]["type"]))
{
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
        ) && ($_FILES["file"]["size"] < 10000000)//Approx. max 1200kb files can be uploaded. (10000000 je u bitima)
        && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        }
        else
        {
            if (file_exists("uploads/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            }
            else
            {
                savePhoto($file_extension);
             }
        }
    }
    else
    {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
}
function savePhoto($file_extension)
{
    try {
        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
        $hash = md5(time().$_FILES['file']['name']);
        $fileName = $_FILES['file']['name'];
        $_FILES['file']['name'] = $hash.".".$file_extension;
        $targetPath = "uploads/" . $_FILES['file']['name']; // Target path where file is to be stored
        move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file

        //snimanje u bazu
        session_start();
        $slika = new Slika();

        $slika->setKorisnikId($_SESSION['korisnikId']);
        $slika->setUrl($targetPath);
        $slika->setVelicina($_FILES["file"]["size"]);

        $slika->setFormat($file_extension);
        list($duzina, $sirina) = getimagesize($targetPath);
        $slika->setDuzina($duzina);
        $slika->setSirina($sirina);
        $sdao = new \Dao\SlikaDao();
        $id = $sdao->create($slika);


        //Informacije za servis FaceUpload
        $info = array();
        $info['image_url'] = $_SERVER['SERVER_NAME']."/".$targetPath;
        $info['original_filename'] = $fileName;
        $info['id'] = $id;
        echo json_encode($info);

    } catch(Exception $e){
        echo $e->getMessage();
        echo $e->getTraceAsString();
        die();
    }
}

?>
