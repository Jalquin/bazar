<?php
class Uzivatel
{
    private $id;
    private $jmeno;
    private $prijmeni;
    private $email;
    private $opravneni;
    private $obrazek;
    private $inzeraty = array();

    public function __construct($id, $jmeno, $prijmeni, $email, $opravneni, $obrazek)
    {
        $this->id = $id;
        $this->jmeno = $jmeno;
        $this->prijmeni = $prijmeni;
        $this->email = $email;
        $this->opravneni = $opravneni;
        $this->obrazek = $obrazek;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getJmeno(){return $this->jmeno;}
    public function setJmeno($jmeno){$this->jmeno = $jmeno;}
    public function getPrijmeni(){return $this->prijmeni;}
    public function setPrijmeni($prijmeni){$this->prijmeni = $prijmeni;}
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;}
    public function getOpravneni(){return $this->opravneni;}
    public function setOpravneni($opravneni){$this->opravneni = $opravneni;}
    public function getObrazek(){return $this->obrazek;}
    public function setObrazek($obrazek){$this->obrazek = $obrazek;}

    public function addInzerat(Inzerat $inzerat)
    {
        array_push($this->inzeraty, $inzerat);
    }

    public function getInzeraty()
    {
        return $this->inzeraty;
    }

}

class UzivatelFactory
{
    public static function createUzivatel($id,$conn)
    {
        //$conn = mysqli_connect("localhost", "root", "", "bazos");
        $jmeno=$prijmeni=$email=$opravneni=$obrazek = "";

        //přidej atributy uživatele
        $uzivatele = mysqli_query($conn, "SELECT * FROM Uzivatel JOIN Obrazky ON Uzivatel.Obrazky_id = Obrazky.id WHERE Uzivatel.id = $id LIMIT 1");
        foreach ($uzivatele as $uzivatel){
            $jmeno = $uzivatel["jmeno"];
            $prijmeni = $uzivatel["prijmeni"];
            $email = $uzivatel["email"];
            $opravneni = $uzivatel["opravneni"];
            $obrazek = $uzivatel["src"];
        }

        $uzivatel = new Uzivatel($id, $jmeno, $prijmeni, $email,$opravneni, $obrazek);

        //přidej všechny inzeráty hráče
        /*$getinzeraty = mysqli_query($conn,"SELECT * FROM Inzerat JOIN Uzivatel_vytvoril_inzerat ON Inzerat.id = Uzivatel_vytvoril_inzerat.Inzerat_id
        JOIN Zbozi ON Inzerat.Zbozi_id = Zbozi.id JOIN Status ON Status.id = Inzerat.inzerat_status_id WHERE Uzivatel_vytvoril_inzerat.Uzivatel_id = $id");*/
        $getinzeraty = mysqli_query($conn,"SELECT * FROM Inzerat JOIN Uzivatel_vytvoril_inzerat ON Inzerat.id = Uzivatel_vytvoril_inzerat.Inzerat_id
        WHERE Uzivatel_vytvoril_inzerat.Uzivatel_id = $id");
        foreach ($getinzeraty as $getinzerat){
            $inzeratid = $getinzerat["id"];
            $inzeratkratkypopis = $getinzerat["kratkypopis"];
            $interatdlouhypopis = $getinzerat["dlouhypopis"];
            $inzeratcena = $getinzerat["cena"];
            $inzerattel = $getinzerat["tel"];
            $inzeratlokace = $getinzerat["lokace"];
            $inzeratstatus = $getinzerat["inzerat_status_id"];
            $inzeratdatumvytvoreni = $getinzerat["datum_zalozeni"];
            $inzeratzboziid = $getinzerat["Zbozi_id"];

            $inzerat = new Inzerat($inzeratid,$inzeratkratkypopis,$interatdlouhypopis,$inzeratcena,$inzerattel,$inzeratlokace,$inzeratstatus,$inzeratdatumvytvoreni);

            //do inzeratu musim pridat zbozi
            $zbozidoinzeratus = mysqli_query($conn,"SELECT * FROM Zbozi WHERE id = $inzeratzboziid LIMIT 1");
            foreach ($zbozidoinzeratus as $zbozidoinzeratu){
                $zboziid = $zbozidoinzeratu["id"];
                $zbozinazev = $zbozidoinzeratu["nazev"];

                $zbozi = new Zbozi($zboziid,$zbozinazev);
                $inzerat->addZbozi($zbozi);
            }

            $uzivatel->addInzerat($inzerat);
        }
        return $uzivatel;
    }
}

/*$uzivatel = UzivatelFactory::createUzivatel(4,$conn);*/


