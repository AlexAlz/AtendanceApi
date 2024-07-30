<?php

class Connection
{
    static public function infoDatabase()
    {
        $infoDB = array(
            "database" => "sistemat_Autotransportespilot",
            "user" => "sistemat_Atpilot",
            "pass" => "kirazero&13"
        );
        return $infoDB;
    }

    static public function connect()
    {
        try {
            $link = new PDO(
                "mysql:host=65.99.248.174;dbname=" . Connection::infoDatabase()["database"],
                Connection::infoDatabase()["user"],
                Connection::infoDatabase()["pass"]
            );
            $link->exec("set names utf8");
        } catch (PDOException $e) {
            die("Error: No se puede conectar a la base de datos");
        }

        return $link;
    }

    static public function apikey()
    {
        return "Y%MzJA:R}:G{=Q(U;wx6T";
    }
}
?>
