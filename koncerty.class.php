<?php

class koncerty
{
    public $conn;

    public function __construct()
    {
        include "db.php";   //vloží skript do skriptu
        // připojení k MariaDB / MySQL pomocí PDO
        $dsn = "mysql:host=localhost;dbname=$dbname;port=3336";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try
        {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        }
        catch(PDOException $e)
        {
            echo "Nelze se připojit k MySQL: ";
            echo $e->getMessage();  //smazat
        }
    }
    public function vratBudouciKoncerty()
    {
        try {
            $datum =date("Y-m-d"); //ziskani dnesniho data
            $stmt = $this->conn->prepare("SELECT * FROM `koncerty` WHERE `datum` >= :datum ORDER BY `datum` ASC");  //SQL select
            $stmt->bindParam(':datum', $datum);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            // možnost řešit zpětnou vazbu
            return true;
        } catch (PDOException $e)
        {
            echo "Chyba zápisu do tabulky pocitadlo: ";  //spíše zakomentovat
            echo $e->getMessage();  //zakomentovat

        }
    }
    public function vratBudouciKoncertyPodleRoku($rok)
{
    try {
        $stmt = $this->conn->prepare("SELECT * FROM `koncerty` WHERE YEAR(`datum`) = :rok ORDER BY `datum` ASC");
        $stmt->bindParam(':rok', $rok, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "Chyba při načítání koncertů: ";
        echo $e->getMessage();
    }
}

}