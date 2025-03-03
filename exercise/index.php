<?php
require_once "../includes/config.php";
if(!(isset($_SESSION['person']) && isset($_SESSION['age']) && isset($_SESSION['email'])))header("Location: ../login.html");
$human = $_SESSION['person'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/mainnav.js"></script>
    <link rel="stylesheet" href="exerc.css">
    <title>Exercies</title>
</head>
<body>
    <div id="header"></div>
    <center>
        <div class="intro">
            <img src="exer.png" alt="man">
            <div class="para">
                <p>Hii... <?php echo $human['name']; ?>,</p>
                <h1>Your Personalized 
                <br>Exercise Plan Is Here</h1>
                <?php  require_once 'exercises.php';
                // $d=$human['nofdays']%7;
                $d=0;
                $wt = $workouts[$d];
                echo '<h2>Day '.($d+1).': '.$wt["title"].'</h2>';
                ?>
            </div>
        </div>
    </center>

    <section class="plan">
        <div class="box">
            <div class="card">
                <h3>Warm-up (10 mins)</h3>
                <p>Light jogging or dynamic stretches</p>
            </div>
            <img src="warmup.png" alt="warmup image">
        </div>

        <?php
            $exer=$wt["exercises"];
            $sets=$wt["sets"];
            $reps=$wt["reps"];
            $imgs=$wt["imgs"];
            for($i=0;$i<count($exer);$i++){
                echo "<div class='box'><div class='card'><h3>".$exer[$i]."</h3>";
                if($reps[$i]=="min")echo "<p>".$sets[$i]." minutes</p></div>";
                else echo "<p>".$sets[$i]." sets x ".$reps[$i]." reps</p></div>";
                echo "<img src='".$imgs[$i]."' alt='exercise image'></div>";
            } 
        ?>

        <div class="box">
            <div class="card">
                <h3>Cool-down (5-10 mins)</h3>
                <p>Stretching or yoga poses</p>
            </div>
            <img src="cooldown.png" alt="cool down image">
        </div>
    </section>
    <script src="exer.js"></script>
</body>
</html>
</body>
</html>