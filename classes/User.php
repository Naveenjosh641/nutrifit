<?php

class User extends Dbh {
    private $email;
    private $password;

    private function enterthis($email, $pswrd) {
        $this->email = $email;
        $this->password = password_hash($pswrd, PASSWORD_DEFAULT);
    }

    public function isEmailExist($email) {
        $query = "SELECT email FROM nftables WHERE email = ?;";
        $stmt = parent::connect()->prepare($query);
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function insert($semail, $spswrd) {
        $this->enterthis($semail, $spswrd);
        $query = "INSERT INTO nftables (email, password) VALUES (?, ?);";
        $stmt = parent::connect()->prepare($query);
        $stmt->execute([$this->email, $this->password]);
    }

    public function check($email, $pswrd){
        $query = "SELECT password FROM nftables WHERE email = ?;";
        $stmt = parent::connect()->prepare($query);
        $stmt->execute([$email]);
        $usr = $stmt->fetch();
        if($usr){
            if(password_verify($pswrd, $usr['password'])){
                return "done";
            }
            else return "notdone";
        }
        return "nouser";
    }
    public function modify($name, $dob, $gen, $htf, $hti, $wt, $goal, $mealcnt){
        require_once '../includes/config.php';
        $eml = $_SESSION['email'];
        if(isset($eml)){
            if($this->isEmailExist($eml)){
                $query = "UPDATE nftables SET name = ?, dob = ?, gender = ?, hgtft = ?, hgtinch = ?, weight = ?, goal = ?, mealcnt = ? WHERE email = ?;";
                // $query = "UPDATE nftables SET name = ?";
                $stmt = parent::connect()->prepare($query);
                $stmt->execute([$name, $dob, $gen, $htf, $hti, $wt, $goal, $mealcnt, $eml]);
            }
        }
    }
    public function getNGHWGM($email){
        if($this->isEmailExist($email)){
            $query = "SELECT name, gender, hgtft, hgtinch, weight, goal, mealcnt, datediff(curdate(),created_at) as nofdays FROM nftables WHERE email = ?;";
            $stmt = parent::connect()->prepare($query);
            $stmt->execute([$email]);
            return $stmt->fetch();
        }
    }
    public function getAge($email){
        if($this->isEmailExist($email)){
            $query = "select dob from nftables where email = ?;";
            $stmt = parent::connect()->prepare($query);
            $stmt->execute([$email]);
            $bday = $stmt->fetch();
            $dob = new DateTime($bday['dob']);
            $today = new DateTime('today');
            $age = $dob->diff($today)->y;
            return $age;
        }
    }
}