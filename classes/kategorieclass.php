<?php

class Kategorie
{
    private $id;
    private $nazev;
    private $image;

    public function __construct($id, $nazev, $image)
    {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->image = $image;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}

    public function getNazev() {return $this->nazev;}
    public function setNazev($nazev) {$this->nazev = $nazev;}

    public function getImage() {return $this->image;}
    public function setImage($image) {$this->image = $image;}
}

class KategorieFactory
{
    public static function createKategorie($id, $conn)
    {
        $getkategories = mysqli_query($conn,"SELECT * FROM Kategorie JOIN Kategorie_ma_obrazky ON 
    Kategorie_ma_obrazky.Kategorie_id = Kategorie.Id 
         JOIN Obrazky ON Obrazky.Id = Kategorie_ma_obrazky.Obrazky_id
         WHERE Kategorie.Id = $id");
        foreach ($getkategories as $getkategorie){
            $kategorieid = $getkategorie["Id"];
            $kategorienazev = $getkategorie["Nazev"];
            $kategorieobrazekid = $getkategorie["Obrazky_id"];
            $kategorieobrazeksrc = $getkategorie["Src"];

            $kategorie = new Kategorie($kategorieid,$kategorienazev,$kategorieobrazeksrc);
        }
        return $kategorie;
    }
}
// přidělej select všech kategorií factory
/*$kategorie = KategorieFactory::createKategorie(1,$conn);*/

?>