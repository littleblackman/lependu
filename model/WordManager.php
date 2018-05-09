<?php


class WordManager
{

    private $bdd;

    public function __construct()
    {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=lependu;charset=utf8", "root", "root");
        } catch (Exception $e) {
            print_r($e);
        }
        $this->$bdd;
    }


    public function getWords()
    {
        $bdd   = $this->bdd;
        $query = "SELECT * FROM word";
        $req   = $bdd->prepare($query);
        $req->execute();

        while($row = $req->fetch(PDO::FETCH_ASSOC)){
            $result[] = strtolower($row['word']);
        };

        return $result;
    }

}