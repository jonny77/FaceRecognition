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
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = "uploads/".$_FILES['file']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

               /* echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
                echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
                echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
                echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";*/
                //snimanje u bazu
                session_start();
                $slika= new Slika();

                $slika->setKorisnikId($_SESSION['korisnikId']);
                $slika->setUrl($targetPath);
                $slika->setVelicina($_FILES["file"]["size"]);

                $slika->setFormat($file_extension);
                list($duzina,$sirina)=getimagesize($targetPath);
                $slika->setDuzina($duzina);
                $slika->setSirina($sirina);
                $sdao=new \Dao\SlikaDao();
                $sdao->create($slika);
                $id=$slika->getIdSlike();
                echo "$id";
                /*echo "ID korisnika je $slika->getKorisnikId()";
                echo "URL slike je $slika->getUrl()";
                echo "Velicina slike je $slika->getVelicina()";
                echo "Format slike je $slika->getFormat()";
                echo "Duzina slike je $slika->getDuzina()";
                echo "Sirina slike je $slika->getSirina()";*/

             }
        }
    }
    else
    {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
}
?>