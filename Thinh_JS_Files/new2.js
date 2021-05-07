var counter = 1;
setInterval(function(){
    document.getElementById('f' + counter).checked = true;
    counter++;
    if(counter > 4){
        counter = 1;
    }
}, 2000);

var counter1 = 1;
setInterval(function(){
    document.getElementById('ff' + counter).checked = true;
    counter1++;
    if(counter1 > 4){
        counter1 = 1;
    }
}, 2000);
