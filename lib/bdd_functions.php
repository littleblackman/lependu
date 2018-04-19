<?php

/**
 * get the bdd connection
 *
 * @return PDO
 */
function getBdd()
{
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=lependu;charset=utf8", "root", "root");
    } catch (Exception $e) {
        print_r($e);
    }
    return $bdd;

}

/**
 *
 * retrive all words
 *
 * @return mixed
 */
function getWords()
{
    $bdd   = getBdd();
    $query = "SELECT * FROM word";
    $req   = $bdd->prepare($query);
    $req->execute();

    while($row = $req->fetch(PDO::FETCH_ASSOC)){
        $result[] = strtolower($row['word']);
    };

    return $result;

}
