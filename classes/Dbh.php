<?php

class Dbh{
    private $servername = "localhost";
    private $username = "nfuser";
    // private $password = "Santhosh@77";
    private $password = "For(maxi)116";
    private $dbname = "nutrifit";

    protected function connect(){
        try{
            $con = new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->password);

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }
        catch(PDOException $e){
            echo "connection failed";
            error_log("Connection Failed " . $e->getMessage(),0);
            die();
        } 
    }
}