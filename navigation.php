<?php
    if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], '/') === false) {
        header('HTTP/1.0 403 Forbidden');
        echo 'You are forbidden!';
        exit;
    }
?>

<link rel="stylesheet" href="css/navigation.css">
<body>
    <div id="header">
        <div class="lheader"><a href="../">NutriFit</a></div>
        <div id="login"><a href="login.html">Login</a></div>
        <div class="down">
            <div class="rheader"><a onclick="clos()" href="../#bmi">BMI</a></div>
            <div class="rheader"><a onclick="clos()" href="diet.html">Diet</a></div>
            <div class="rheader"><a onclick="clos()" href="exercise.html">Exersises</a></div>
            <div class="rheader"><a onclick="clos()" href="about.html">About Us</a></div>
        </div>
    </div>

    <div id="dropdown">
        <button type="button" id="drops" title="dropdown" onclick="droping()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </button>
    </div>
</body>