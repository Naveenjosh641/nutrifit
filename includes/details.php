<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once 'config.php';
    if(isset($_SESSION["email"])){
        $name = strtolower(htmlspecialchars($_POST['name']));
        if(empty($name)){
            header("Location: ../details.html?Enter Your Name");
            die();
        }
        $dob = htmlspecialchars($_POST['dob']);
        if(empty($dob)){
            header("Location: ../details.html?Enter Your Date of Birth");
            die();
        }
        $gender = htmlspecialchars($_POST['gender']);
        if(empty($gender)){
            header("Location: ../details.html?Enter Your Gender");
            die();
        }
        $height = htmlspecialchars($_POST['height']);
        if(empty($height)){
            header("Location: ../details.html?Enter Your Height");
            die();
        }
        $weight = htmlspecialchars($_POST['weight']);
        if(empty($weight)){
            header("Location: ../details.html?Enter Your Weight");
            die();
        }
        $goal = htmlspecialchars($_POST['goal']);
        if(empty($goal)){
            header("Location: ../details.html?Enter Your Goal");
            die();
        }
        $mealcnt = htmlspecialchars($_POST['mealcnt']);
        if(empty($mealcnt)){
            header("Location: ../details.html?Enter Your Meal Count");
            die();
        }

        function isDateInvalid($date){
            $peices = explode('-',$date);
            if(count($peices) === 3){
                $y = $peices[0];
                $m = $peices[1];
                $d = $peices[2];
                return !checkdate($m,$d,$y);
            }
            return true;
        }
        if(isDateInvalid($dob)){
            header("Location: ../details.html?Enter Valid Date of Birth");
            die();
        }
        if(!($gender=='m' || $gender == 'f')){
            header("Location: ../details.html?Enter a Valid Gender");
            die();
        }
        if($height>3 && $height<8){
            $ht = (string)$height;
            $ht = explode('.',$ht);
            $feet = $ht[0];
            $inch = $ht[1];
            if(!((int)$inch>=0 && (int)$inch<12) && !((int)$feet>=3 && (int)$feet<=8)){
                header("Location: ../details.html?Enter a Valid Height");
                die();
            }
        }else {
            header("Location: ../details.html?Enter a Valid Height");
            die();
        }
        if(!($weight>=30 && $weight<=200)){
            header("Location: ../details.html?Enter a Valid Weight");
            die();
        }
        if(!($goal == "weight loss" || $goal == "fitness" || $goal == "muscle growth")){
            header("Location: ../details.html?Select a Valid Goal");
            die();
        }
        if(!($mealcnt === "2" || $mealcnt == "3" || $mealcnt === "4" || $mealcnt === "5")){
            header("Location: ../details.html?Select a Valid Meal Count");
            die();
        }

        require_once '../classes/Dbh.php';
        require_once '../classes/User.php';
        $usr = new User();
        $usr->modify($name, $dob, $gender, $feet, $inch, $weight, $goal, $mealcnt);
        $_SESSION['person']=$usr->getNGHWGM($_SESSION["email"]);
        $_SESSION['age']=$usr->getAge($_SESSION["email"]);
        echo "done";
        header("Location: ../diet");
        // echo $name, $dob, $gender, $feet, $inch, $weight, $goal, $mealcnt;
    }
    else{
        header("Location: ../signup.html");
    }
}
else{
    header("Location: ../login.html");
}