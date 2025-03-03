<?php
    // if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], '/') === false) {
    //     header('HTTP/1.0 403 Forbidden');
    //     echo 'You are forbidden!';
    //     exit;
    // }
    require_once 'includes/config.php';
    if(!(isset($_SESSION['person']) && isset($_SESSION['age']) && isset($_SESSION['email'])))header("Location: login.html");
    $person = $_SESSION['person'];
    $ht=((int)$person['hgtft'])*12;
    if(!empty($person['hgtinch']))$ht+=(int)$person['hgtinch'];
    $ht=$ht*2.54/100;
    $bmi = round($person['weight']/($ht*$ht),1);
    if($bmi<18.5) $_SESSION['bmi']='Under Weight';
    else if($bmi>=18.5 && $bmi<25) $_SESSION['bmi']='Normal Weight';
    else if($bmi>=25 && $bmi<30) $_SESSION['bmi']='Over Weight';
    else $_SESSION['bmi']='Obesity';
?>

<link rel="stylesheet" href="/css/mainnavi.css">
<body>
<div id="profile">
    <div class="btns">
        <button type="button" class="clsbtn"><img src="../image/close.svg" alt="close"></button>
        <a href="../details.html"><img src="../image/edit.svg" alt="edit"></a>
    </div>
    <img class="gen" src="../image/<?php if($person['gender']=='m') echo "boy.webp"; else echo "girl.png";?>" alt="Boy">
    <h2><?php echo $person['name']; ?></h2>
    <div class="sbs">
        <div><b>Age:</b>      <p><?php echo $_SESSION['age']; ?> years</p></div>
        <div><b>Height:</b>   <p><?php echo $person["hgtft"]; if($person["hgtinch"] != '') echo '.'.$person["hgtinch"]; ?> ft</p></div>
        <div><b>Weight:</b>   <p><?php echo $person["weight"]; ?> kgs</p></div>
        <div><b>Meals:</b>    <p><?php echo $person["mealcnt"]; ?> per day</p> </div>
        <div><b>Category:</b> <p class="cap"><?php echo $_SESSION['bmi'] ?></p></div>
        <div><b>Goal:</b>     <p class="cap"><?php echo $person["goal"]; ?></p></div>
        <div><b>Progress:</b>   <p><?php echo $person["nofdays"]/7; ?> weeks</p></div>
    </div>
</div>

<header>
    <div class="logo">
        <p>NUTRIFIT</p>
        <p>NF</p>
    </div>
    <nav class="nav">
        <a href="../diet/">DIET</a>
        <a href="../exercise/">EXERCISE</a>
    </nav>
    <button type="button" class="probtn">
        <img src="../image/<?php if($person['gender']=='m') echo "boy.webp"; else echo "girl.png";?>" alt="profile">
    </button>
</header>
</body>