<?php

class Conexao
{
    private static $connection;

    private function __construct(){}

    public static function getConnection() {

        define('DB_HOST'        , "huarlen.ddns.net,1434");
        define('DB_USER'        , "sa");
        define('DB_PASSWORD'    , "Gwsql2008");
        define('DB_NAME'        , "GWPDV04");

        $pdoConfig  = sqlsrv . ":". "Server=" . DB_HOST . ";";
        $pdoConfig .= "Database=".DB_NAME.";";

        try {
            if(!isset($connection)){
                $connection =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
         } catch (PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
         }
     }
}
?>