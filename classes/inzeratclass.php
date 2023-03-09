<?php

class Inzerat
{
    private $id;
    private $kratkypopis;
    private $dlouhypopis;
    private $cena;
    private $tel;
    private $lokace;
    private $status;
    private $datum_vytvoreni;

    private $zbozi = array();

    public function __construct($id, $kratkypopis, $dlouhypopis, $cena, $tel, $lokace, $status, $datum_vytvoreni)
    {
        $this->id = $id;
        $this->kratkypopis = $kratkypopis;
        $this->dlouhypopis = $dlouhypopis;
        $this->cena = $cena;
        $this->tel = $tel;
        $this->lokace = $lokace;
        $this->status = $status;
        $this->datum_vytvoreni = $datum_vytvoreni;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getKratkyPopis() {return $this->kratkypopis;}
    public function setKratkyPopis($kratkypopis) {$this->kratkypopis = $kratkypopis;}
    public function getDlouhyPopis() {return $this->dlouhypopis;}
    public function setDlouhyPopis($dlouhypopis) {$this->dlouhypopis = $dlouhypopis;}
    public function getCena() {return $this->cena;}
    public function setCena($cena) {$this->cena = $cena;}
    public function getTel() {return $this->tel;}
    public function setTel($tel) {$this->tel = $tel;}
    public function getLokace() {return $this->lokace;}
    public function setLokace($lokace) {$this->lokace = $lokace;}
    public function getStatus() {return $this->status;}
    public function setStatus($status) {$this->status = $status;}
    public function getDatumVytvoreni() {return $this->datum_vytvoreni;}
    public function setDatumVytvoreni($datum_vytvoreni) {$this->datum_vytvoreni = $datum_vytvoreni;}

    public function addZbozi(Zbozi $zbozi)
    {
        array_push($this->zbozi, $zbozi);
    }

    public function getZbozi()
    {
        return $this->zbozi;
    }
}

?>