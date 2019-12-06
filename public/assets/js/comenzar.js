//Variables
var contador_s = 0;
var contador_m = 0;
var temp;


//Funciones
function comenzarEjercicio() {
    alert('Realice cada ejercicio sincronizado con el sonido, recuerda cuando completes un minuto de ejercicio, tienes que descansar un minuto.');
    temporizador();
    comenzar = document.getElementById("comenzar");
    parar = document.getElementById("parar");
    comenzar.style.display = 'none';
    parar.style.display = 'block';
}

function temporizador() {

    var s = document.getElementById("segundos");
    var m = document.getElementById("minutos");

    temp = setInterval(function () {
        if (contador_s == 60)
        {
            contador_s = 0;
            contador_m++;
        }

        contador_s++;
        var audio = document.getElementById("audio");

        if(contador_s % 2 == 0) {
            reproducir();
        }

        s.innerHTML = contador_s;
        m.innerHTML = contador_m;

        if(contador_s == 10) {
            clearInterval(temp);
            alert("Felicidades Termino con exito el ejercicio");
            parar = document.getElementById("parar");
            parar.style.display = "none";
            link = document.getElementById("siguiente");
            link.style.display = "block";
        }
        
    }, 1000);

    
}

function reproducir() {
    audio.play();
}

function detener() {
    clearInterval(temp);
    alert("Detuviste el ejercicio antes de tiempo, por favor evalua el dolor con sinceridad");
    parar = document.getElementById("parar");
    parar.style.display = "none";
    link = document.getElementById("siguiente");
    link.style.display = "block";
    console.log(link);
}