let box = document.querySelectorAll('.box');

for(i=0;i<box.length;i++){
    if(i%2==1){
        box[i].style.flexDirection = "row-reverse";
    }
}