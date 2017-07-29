<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

$ch = curl_init();

$post=[
    'nombre'=> 'ABC',
	'marca'=> 'APPLE',
	'modelo'=> 'S8',
	'precioFactura'=> '4500',
	'email'=> 'ls@as.com',
	'img'=> 'imagen.jpg',
	'imgRuta'=> 'img/product/'
];


curl_setopt($ch, CURLOPT_URL,"http://localhost/REST-N1/API/insert");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
if ($server_output == "OK") { ... } else { ... }

?>