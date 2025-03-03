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
    <link rel="stylesheet" href="diet.css">
    <title>Personalized Diet Plan</title>
</head>
<body>

    <div id="header"></div>

    <div class="center">
        <div class="intro">
            <div class="para">
                <p>Hii... <?php echo $human['name']; ?>,</p>
                <h1>Your Personalized Diet
                <br>Plan Is Here</h1>
                <?php  require_once 'recipes.php';
                // $d=$human['nofdays']%7;   //changeable
                $d=0;
                echo '<h2>Day '.($d+1).': '.$recipes[$d]["diet"].' Diet</h2>';
                ?>
            </div>
            <img src="imgs/man.png" alt="man">
        </div>

        <?php
            $k=1;
            $a=1;
            $n = $human['mealcnt'];
            if ($n == 5) {
                $a = 0;
                $n=4;
            }
            for($i=$a; $i <= $n; $i++){
                $rec = $recipes[$d][$i];
                echo '<div class="dish">
                        <div class="actual">
                            <img src="imgs/'.$rec['image'].'">
                            <div class="frnt">
                                <div class="border">
                                    <div class="info">
                                        <b>Protein</b><span>'.$rec["info"][0].'g</span>
                                    </div>
                                </div>
                                <div class="border">
                                    <div class="info">
                                        <b>Carbs</b><span>'.$rec["info"][1].'g</span>
                                    </div>
                                </div>
                                <div class="border">
                                    <div class="info">
                                       <b>Fiber</b><span>'.$rec["info"][2].'g</span>
                                    </div>
                                </div>
                            </div>
                            <a href="'.$rec["link"].'" target="_"><h1><span>'.$k++.'</span>'.$rec["name"].'</h1></a>
                        </div>
                        <div class="details">
                        <h2>ingredients</h2>
                        <ul>';
                    $arr = $rec["ingred"];
                    for($j=0;$j < count($arr);$j++){
                        echo '<li>'.$arr[$j].'</li>';
                    }
                echo '</ul>
                    </div>
                </div>';
            }
        ?>

    </div>

</body>
<script src="diet.js"></script>
</html>