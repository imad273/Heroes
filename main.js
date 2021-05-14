function engin(){

    var time = new Date(),
        hrs = time.getHours(),
        mn = time.getMinutes(),
        sec = time.getSeconds();

        if(sec < 10){
            sec = "0" + sec;
        };

        if(mn < 10){
            mn = "0" + mn;
        };

        if(hrs < 10){
            hrs = "0" + hrs;
        };

        document.getElementById("hrs").innerHTML = hrs;
        document.getElementById("mn").innerHTML = mn;
        document.getElementById("sec").innerHTML = sec;

}

engin();

setInterval("engin()", 1000);

// End //