let i = 1;



setInterval(
    function slider() {
        if (i == 1) {
            i = 2;
            document.getElementById('slider').innerHTML = "<button onclick='slidedown()'><</button><img src='./img/2.jpg' alt='slide2'><button onclick='slideup()'>></button>";
        } else if (i == 2) {
            i = 3;
            document.getElementById('slider').innerHTML = "<button onclick='slidedown()'><</button><img src='./img/3.jpg' alt='slide3'><button onclick='slideup()'>></button>";
        } else {
            i = 1;
            document.getElementById('slider').innerHTML = "<button onclick='slidedown()'><</button>><img src='./img/1.jpg' alt='slide1'><button onclick='slideup()'>></button>";
        }
    }
, 3000);