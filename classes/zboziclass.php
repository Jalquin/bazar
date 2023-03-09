<?php

class Zbozi
{
    private $id;
    private $nazev;

    private $kategorie = array();

    public function __construct($id, $nazev)
    {
        $this->id = $id;
        $this->nazev = $nazev;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}

    public function getNazev() {return $this->nazev;}
    public function setNazev($nazev) {$this->nazev = $nazev;}

    public function addKategorie(Kategorie $kategorie)
    {
        array_push($this->kategorie, $kategorie);
    }
    public function getKategorie()
    {
        return $this->kategorie;
    }

}

?>