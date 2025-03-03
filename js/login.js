function login(event){
    let sbtn = document.querySelector('input[type=submit]');
    sbtn.style.backgroundColor = "lightgray";
    let leml = document.querySelector('input[type=email]');
    let pass = document.querySelector('input[type=password]');
    if(leml.value != '' && pass.value != ''){
        const formData = new FormData(document.querySelector('form'));
        event.preventDefault();
        fetch('../includes/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if(response.redirected) window.location.href = response.url;
            else return response.text();
        })
        .then(data => {
            if(data){
                alert(data);
                pass.value = '';
                sbtn.style.backgroundColor = "buttonface";
                if(data == "Invalid User"){
                    leml.value = ' ';
                }
            }
        })
    }
}