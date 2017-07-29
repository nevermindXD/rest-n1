$("test").click(function(){
        $.post("http://localhost/REST-N1/API/insert",
        {
          nombre: "Donald Duck",
          marca: "motorola",
          modelo: "moto g",
          precioFactura: "55988",
          email: "shando@gmai.com",
          img: "blabla.jpg",
          rutaImg: "c:hasdasdj"
        },
        function(data){
            alert("Data: " + data);
            event.preventDefault
        });
    });