$(document).ready(function () {
    'use strict';




    //scrollReveal inicializar 
    scrollReveal('.m-fip', 'fadeInUp');
    scrollReveal('.m-fir', 'fadeInRight');
    scrollReveal('.m-fil', 'fadeInLeft');

    //scrollto 
    document.getElementById('scroll_rcv').addEventListener('click', function (e) {
        e.preventDefault();
        Document.querySelector('.a_caracteristicas').scrollIntoView({
            behavior: 'smooth'
        });

    });
    document.getElementById('scroll_vntj').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.a_ventajas').scrollIntoView({
            behavior: 'smooth'
        });

    });
    document.getElementById('scroll_sbq').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.a_datos').scrollIntoView({
            behavior: 'smooth'
        });

    });
    document.getElementById('scroll').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('.a_presentacion').scrollIntoView({
            behavior: 'smooth'
        });

    });


    //Procesar forma con ajax
$('#forma_main').submit(function(e) {
        e.preventDefault(); 
        var form = $(this),
            formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url:    'php/forma_main.php',
            type:   'POST',
            data:   formdata ? formdata : form.serialize(),
         	cache: false,
        	contentType: false,
			processData: false,
            success: function(response){
                console.log(response); 
                
               setTimeout(function(){
                   $('.hero').css({
                    'background-image':'url(img/hero_gracias.svg)',
                    'background-position':'50% 50%'
                });
                $('#titulo_hero').text('Gracias, por favor revisa tu correo');
                    $('.forma-cotizar').removeClass('inplace');
                $('.seccion,.hero').removeClass('blurred');
               },1000);
            }, 
            error: function(error){
                $('.form-group').addClass('has-danger');
                console.log(error);
            }
        }).done(function(){
            $('.fa-cog').css('display','inline-block'); 
        });
            
       
         
          
       }); 
    
        
   





    /**
    
        var spreadsheetID = "1PH5l5CaPVrEbx3gthAzWSwVhiBWst2vr-OSsHAzQl3E";
 
 // Make sure it is public or set to Anyone with link can view 
 var url = "https://spreadsheets.google.com/feeds/list/" + spreadsheetID + "/1/public/values?alt=json";
 
// make JSON call to Google Data API
$.getJSON(url, function(data) {
    console.log(data);
});
    
    
    
    
    
    
    
    
    
    function start() {
        // 2. Initialize the JavaScript client library.
        gapi.client.init({
            'apiKey': 'AIzaSyD7Ireto6dl2-fzb7mk--9Nsj9rdPJv_jg',
            // clientId and scope are optional if auth is not required.
            'clientId': '213353840573-bd0da3uv0fkek793qpfl7t98qq1las7g.apps.googleusercontent.com',
            'scope': 'https://www.googleapis.com/auth/spreadsheets.readonly'
        }).then(function () {
            // 3. Initialize and make the API request.
            return gapi.client.sheets.spreadsheets.values.get({
                spreadsheetId: '1PH5l5CaPVrEbx3gthAzWSwVhiBWst2vr-OSsHAzQl3E',
                range: 'LISTADO',
            })
        }).then(function (response) {
            console.log(response.result);
        }, function (reason) {
            console.log('Error: ' + reason.result.error.message);
        });
    };
    // 1. Load the JavaScript client library.
    gapi.load('client', start);
    **/



    //forma principal



    /*
       for (var i=0; i<R.length;i++){
           $('#titulo').append(
               '<p>' + 
               escape(R[i].title['$t'].replace(/\s/g,'')) + 
               '</p>'
           );
       }*/

    var sheetid='1PH5l5CaPVrEbx3gthAzWSwVhiBWst2vr-OSsHAzQl3E',
        url = 'https://spreadsheets.google.com/feeds/list/'+sheetid+'/1/public/values?alt=json', 
        listado = {};
    

     
    

    $('.btn_cotizador').click(function (e) {
        e.preventDefault();
        $('.forma-cotizar').addClass('inplace');
        $('.seccion,.hero').addClass('blurred');
        var result = "";
      /*Evaluando con for 
        for (var i = 0; i < listado.length; i++) {
            var temp = listado[i].title['$t'].replace(/\s/g, '');
            if (temp !== result || result === '') {
                $('#marcas_select').append(
                    '<option value=' +
                    temp +
                    '>' +
                    temp +
                    '</option>'
                );
                result = temp;
            }
            console.log(listado[i].content['$t']); 
        }
        
              
            $.each(data,function(i,o){
			
			if (o.MARCA !== result || result==='')	{
				$('#marcas_select').append(
				'<option value=' +
				o.MARCA + 
				'>'	+ 
				o.MARCA +
				'</option>'
				);
				result = o.MARCA; 
			}
			
			});
      */
     
        
        $.ajax({
			dataType:'json',
			url:url, 
			error:function(){
				$('#marcas_select').html('<option>'+'Hubo un error, inténtalo otra vez'+'</option>');
			}
		}).done(function(data){
            setTimeout(function(){
                $('[name="cargando_marcas"]').remove();
            },1500); 
            listado = data.feed.entry;
            
               $.each(listado,function(i, o){
            var temp = o.title['$t'].replace(/\s/g, '');
            if (temp !== result || result === '') {
                $('#marcas_select').append(
                    '<option value=' +
                    temp +
                    '>' +
                    temp +
                    '</option>'
                );
                result = temp;
                $('option[name="cargando_marcas"]').remove(); 
            } 
            
        });
            
            
            
            
            
      
        });
			
			
			
			
         

    });

    //marcas y equipos 
    //cargar modelos




    var valor,y;
    $('#marcas_select').change(function () {
        valor = $(this).val();
        y=0; 
        $('#modelos_select').html('');
       
        $.each(listado, function (i, o) {
           var temp = o['gsx$marca']['$t'].replace(/\s/g, '');
            if (temp === valor) {
                if(y===0){
                    $('input[name="prim"]').val(o['gsx$primamensual']['$t']);
                    console.log($('input[name="prim"]').val()); 
                }
                $('#modelos_select').append(
                    '<option value=' +
                    o['gsx$modelo']['$t'] +
                    '>' +
                    o['gsx$modelo']['$t'] +
                    '</option>'
                );
                y++;
            } 
        });

    });
    
    //prima sugerido 
     //determinar valor cuota 
    $('#modelos_select').change(function(){
        var modelo_sel = $(this).val();  
        $.each(listado,function(i,o){
            var a = o['gsx$modelo']['$t'].replace(/\s/g, ''); 
            if(a === modelo_sel){
                $('input[name="prim"]').val(o['gsx$primamensual']['$t'])
            }
          
        });
    });
    
    
    
    //cerrar
    $('.forma-cotizar .close').click(function () {
        $('.forma-cotizar').removeClass('inplace');
        $('.seccion,.hero').removeClass('blurred');
    });


    //Validar nombre 

    $('input[name="forma_index_nombre"]').blur(function () {
        var nom = $(this).val();
        $('#nombre_index').text(nom + ', Gracias por considerar Jopi');
    });

   


    //envio ajax





    //overlay 
    $('.qnSms').click(function (e) {
        e.preventDefault();
        $('.overlay-content').addClass('inplace');
        $('.seccion,.hero').addClass('blurred');
        $.ajax({
            dataType: 'json',
            url: 'http://apptest.jopi.com.mx/wp-json/wp/v2/pages/4/'
        }).done(function (data) {
            $('.content-header').html(data.title.rendered);
            $('.content-body').html(data.content.rendered);
        });
    });

    $('.overlay-content .close').click(function () {
        $('.overlay-content').removeClass('inplace');
        $('.seccion,.hero').removeClass('blurred');
    });

    //overlay FAQ
    $('#faq').click(function (e) {
        e.preventDefault();
        $('.overlay-content').addClass('inplace');
        $('.seccion,.hero').addClass('blurred');
        $.ajax({
            dataType: 'json',
            url: 'http://app.jopi.com.mx/wp-json/wp/v2/pages/20/'
        }).done(function (data) {
            $('.content-header').html(data.title.rendered);
            $('.content-body').html(data.content.rendered);
        });
    });

    $('.overlay-content .close').click(function () {
        $('.overlay-content').removeClass('inplace');
        $('.seccion,.hero').removeClass('blurred');
    });


    //overlay video
    $('.video_pres').click(function (e) {
        e.preventDefault();
        $('.content-video').addClass('inplace');
        $('.seccion,.hero').addClass('blurred');
        document.querySelector('#vid_main').scrollIntoView({
            behavior: 'smooth'
        });
        var v = document.getElementById('vid_main');
        v.src = 'video/jopi.mp4';
        v.oncanplaythrough = function () {
            setTimeout(function () {
                v.play();
            }, 500);
        };

    });

    $('.content-video .close').click(function () {
        $('.content-video').removeClass('inplace');
        $('.seccion,.hero').removeClass('blurred');
    });









    //chart.js


    //Cambiar el delay de la animación 
    Chart.defaults.global.plugins.deferred = {
        xOffset: 200,
        yOffset: 0,
        delay: 4000
    };

    Chart.defaults.global.animation.duration = 2000;

    //Gráfica celulares protegidos
    var ctx = document.getElementById("Chart_cel_asegurados").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["% Celulares asegurados", "% Celulares desprotegidos"],
            datasets: [{
                label: 'Celulares protegidos en México',
                data: [5, 95],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
                borderWidth: 1
        }]
        },
        options: {}
    });





    //gráfica robos en méxico diarios


    var ctx2 = document.getElementById("Chart_cel_robo").getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ["Robos de celular diarios en México"],
            datasets: [{
                label: 'celulares robados',
                data: [1670],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)'


            ],
                borderColor: [
                'rgba(255,99,132,1)'
            ],
                borderWidth: 2
        }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
            }]
            }
        }
    });



    var ctx3 = document.getElementById("Chart_asalto").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ["Asaltos por hora en México"],
            datasets: [{
                label: 'Asaltos por hora',
                data: [30],
                backgroundColor: [

                'rgba(75, 192, 192, 0.2)'

            ],
                borderColor: [
                'rgba(75, 192, 192, 1)'

            ],
                borderWidth: 2
        }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
            }]
            }
        }
    });





});