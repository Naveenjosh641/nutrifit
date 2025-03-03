let box = document.querySelectorAll('.dish');
let img = document.querySelectorAll('.dish .actual .frnt');
let imgs = ['owbn', 'gcs', 'bswq','gywn']
let border = document.querySelectorAll('.dish .actual .frnt .border');
let deg = document.querySelectorAll('.dish .actual .frnt .border .info span');

for(i=0;i<border.length && i<deg.length;i++){
    let val = deg[i].innerHTML.replace('g','%');
    border[i].style.background = `conic-gradient(lime 0% ${val}, white ${val} 100%)`;
}
for(i=0;i<img.length;i++){
    if(i%2==1){
        box[i].style.flexDirection = "row-reverse";
    }
}
