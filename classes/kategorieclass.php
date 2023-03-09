<?php

class Kategorie
{
    private $id;
    private $nazev;

    public function __construct($id, $nazev)
    {
        $this->id = $id;
        $this->nazev = $nazev;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}

    public function getNazev() {return $this->nazev;}
    public function setNazev($nazev) {$this->nazev = $nazev;}
}

?>