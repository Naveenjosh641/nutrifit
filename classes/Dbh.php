<?php

class Dbh{
    private $servername = "localhost";

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
