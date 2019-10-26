$(document).ready(function () {
    var URLactual = window.location.pathname;
    var id = URLactual.substring(25, 27);

    // Metodo Acordion
    $("#myAccordion").accordion();

    // Metodo para poder arrastrar
    $(".source li").draggable({ helper: "clone"});

    // Metodo para soltar un draggable
    $("#recepcion").droppable({
        drop: function (event, ui) {
            $("#items").append($("<li></li>").text(ui.draggable.text()));
            console.log(ui.draggable.text());
            var datos = {
                "nombre": ui.draggable.text(),
                "paciente": id
            };
            console.log(datos);
            $.ajax({
                type: 'POST',
                url: "/paciente/registrar",
                data: datos,
                beforeSend: function () {
                    console.log("Enviando Ejercicio");
                },
                success: function (response) {
                    console.log(response);
                },
                error: function () {
                    console.log("error");
                }
            });
        }
    });
});