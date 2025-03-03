let n=0;

let chform = document.getElementById('chform');
function genotp(event){
    let eml = document.querySelector(".combine input[type=email]");
    if(eml.value != ''){
        let athent = document.getElementById("athent");
        let firstfrm = document.getElementById("form1");
        const formData = new FormData(firstfrm);
        let btn = document.getElementById("next");
        btn.innerHTML = '';
        let d = '<form id="form2" method="post"><input type="number" name="otp" id="otp" placeholder="OTP" requried><input type="submit" value="Verify" onclick="verotp(event)"><p style="margin-top: 10px;">It may take a while. Check your spam or junk folder.</p></form>';
        chform.innerHTML = d;
        athent.style.height = document.getElementById("form1").scrollHeight + document.getElementById("chform").scrollHeight + "px";
        event.preventDefault();
        fetch("../includes/validemail.php" ,{
            method : "POST",
            body : formData
        })
        .then(response => response.text())
        .then(data => {
            if(data == "null" || data == "notValid"){
                btn.innerHTML = '<input type="submit" id="vereml" value="Next" onclick="genotp(event)">';
                chform.innerHTML = '';
                athent.style.height = "75px";
            }
            if(data == "null"){
                alert("Enter Your Email");
            }
            else if (data == "notValid"){
                alert("Enter a valid Email!");
            }
            else if(data == "email exist"){
                alert("Email already exists\nLogin with your credentials");
                window.location.replace('/login.html');
            }
            else if(data == "sent"){
                eml.removeAttribute('required');
                eml.setAttribute('readonly', true);
            }
            else{
                console.log("hi");
                console.log(data);
            }
        })
    }
}
function verotp(event){
    let one = document.querySelector("form #otp");
    event.preventDefault();
    if(one.value != ''){
        const formData2 = new FormData(document.getElementById("form2"));
        fetch("../includes/validotp.php",{
            method : "POST",
            body :formData2
        })
        .then(response => response.text())
        .then(data2 =>{
            if(data2 == ''){
                alert("Enter OTP");
            }
            else if(data2 === "notvalid"){
                alert("OTP not valid");
            }
            else if(data2 === "incorrect"){
                alert("Incorrect OTP");
            }
            else if(data2 === "yes"){
                chform.innerHTML = '<form id="form3" method="post"><input type="password" name="spswrd" id="spswrd" placeholder="Password" autocomplete="current-password" required><input type="password" name="conf-pass" id="conf-pass" placeholder="Confirm-Password" autocomplete="current-password" required><input type="submit" value="Sign Up" onclick="signup(event)"></form>';
                athent.style.height = document.getElementById("form1").scrollHeight + document.getElementById("chform").scrollHeight + "px";
            }
            else{
                console.log(data2);
            }
        })
    }
    else{
        alert("Enter OTP");
    }
}


function signup(event){
    event.preventDefault();
    let btn = document.querySelector('#form3 input[type=submit]');
    btn.style.backgroundColor = "lightgray";
    const passes = document.querySelectorAll('#form3 input[type=password]');
    let pass = passes[0].value;
    let confpass = passes[1].value;
    if(pass != '' && confpass != ''){
        if(pass === confpass){
            console.log("yes");
            const formData = new FormData(document.getElementById('form3'));
        
            // Send form data to the PHP file using fetch
            fetch('/includes/signup.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if(response.redirected){
                    window.location.href = response.url;
                }
                else{
                    return response.text();
                }
            })
            .then(data => {
                if(data) alert(data);
            })
            .catch(error => console.error('Error:', error));
        }
        else{
            passes[0].value = '';
            passes[1].value = '';
            btn.style.backgroundColor = "black";
            alert("Password and Confirm Password must be same");
        }
    }
}