$(document).ready(function () {
    // $.ajax({
    //     url: 'http://localhost/~eduardoherreradominguez/rest-n1/API/get/2', //aqui va tu URL
    //     type: 'GET',
    //     success: function (response) {//lo que recibe de parametro la funcion, es la respuesta de tu peticion GET

            var response =[
                { id_cotizacion: 1, nombre: "Eduardo", marca:"Herrera", modelo: "asfdda", precioFactura: 123213, email:"asfdasfddsaf", img: "img", rutaImg: "asfa"},
                { id_cotizacion: 1, nombre: "Eduardo", marca:"Herrera", modelo: "asfdda", precioFactura: 123213, email:"asfdasfddsaf", img: "img", rutaImg: "asfa"},
                { id_cotizacion: 1, nombre: "Eduardo", marca:"Herrera", modelo: "asfdda", precioFactura: 123213, email:"asfdasfddsaf", img: "img", rutaImg: "asfa"},
                ]; 
            var tr;
            
            for (var i = 0; i < response.length; ++i) {
                var id_cotizacion = response[i].id_cotizacion;
                var nombre = response[i].nombre;
                var marca = response[i].marca;
                var modelo = response[i].modelo;
                var precioFactura = response[i].precioFactura;
                var email = response[i].email;
                var img = response[i].img;
                var rutaImg = response[i].rutaImg;

                
                //   console.log(response); 
                // var id_cotizacion = response[i]['id_cotizacion'];
                // var nombre = response[i]['nombre'];
                // var marca = response[i]['marca'];
                // var modelo = response[i]['modelo'];
                // var precioFactura = response[i]['precioFactura'];
                // var email = response[i]['email'];
                // var img = response[i]['img'];
                // var rutaImg = response[i]['rutaImg'];

                //Dynamic Table

                    tr = $('<tr/>');
                    tr.append("<td>" + id_cotizacion + "</td>");
                    tr.append("<td>" + nombre + "</td>");
                    tr.append("<td>" + marca + "</td>");
                    tr.append("<td>" + modelo + "</td>");
                    tr.append("<td>" + precioFactura + "</td>");
                    tr.append("<td>" + email + "</td>");
                    tr.append("<td>" + img + "</td>");
                    tr.append("<td>" + rutaImg + "</td>");
                    $('#table').append(tr);



            // }
        }
    // });
});


