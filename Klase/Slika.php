<?php
class Slika{
    private $idSlike;
    private $korisnikId;
    private $url;
    private $velicina;
    private $format;
    private $duzina;
    private $sirina;

    public function _construct(){
        $this->idSlike=null;
        $this->korisnikId=null;
        $this->url=null;
        $this->velicina=null;
        $this->format=null;
        $this->duzina=null;
    }
    public function getIdSlike(){
        return $this->idSlike;
    }
    public  function  setIdSlike($idSlike){
        $this->idSlike = $idSlike;
    }
    public function getKorisnikId(){
        return $this->korisnikId;
    }
    public  function  setKorisnikId($id){
        $this->korisnikId = $id;
    }
    public function getUrl(){
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getDuzina()
    {
        return $this->duzina;
    }

    public function setDuzina($duzina)
    {
        $this->duzina = $duzina;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function getVelicina()
    {
        return $this->velicina;
    }

    public function setVelicina($velicina)
    {
        $this->velicina = $velicina;
    }

    public function getSirina()
    {
        return $this->sirina;
    }

    public function setSirina($sirina)
    {
        $this->sirina = $sirina;
    }

}

?>