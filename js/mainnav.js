document.addEventListener('DOMContentLoaded', function(){
    fetch("../mainnav.php")
    .then(Response => Response.text())
    .then(data => {
        document.getElementById("header").innerHTML = data;
        changes();
    });
});
function changes(){
    let navbar = document.querySelector("header");
    let prevpos = window.scrollY;

    window.onscroll = function(){
        let curntpos = window.scrollY;
        let tmp;
        
        if(window.innerWidth >= 425){
            tmp = "-100px";
        }
        else{
            tmp = "-50px";
        }

        if(curntpos > prevpos && curntpos > 100){
            navbar.style.top=tmp;
            prfl.style.display = "none";
        }
        else{
            navbar.style.top="0";
        }
        if(curntpos > 150){
            navbar.style.backgroundColor = "rgba(0,0,0,0.8)";
            document.querySelector("header .nav").style.backgroundColor = 'unset';
        }
        else if(curntpos == 0){
            navbar.style.backgroundColor = 'unset';
            if(window.location.pathname == '/exercise/')clr='#00101f';
            else if(window.location.pathname == '/diet/') clr='#0B1F0F';
            else clr = black;
            document.querySelector("header .nav").style.backgroundColor = clr;
        }

        prevpos = curntpos;
    }
    
    let pbtn = document.querySelector('.probtn');
    let prfl = document.querySelector('#profile');

    pbtn.addEventListener("click",() => {
        window.scrollTo({top:0});
        prfl.style.display = "flex";
    });
    document.querySelector('.clsbtn').addEventListener("click",function(){
        prfl.style.display = "none";
    });
}