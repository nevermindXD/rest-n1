<?php	


require __DIR__ . '/PHPMailer/PHPMailerAutoload.php';
if (isset($_POST['email'])){
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);}
if (isset($_POST['forma_index_nombre'])){$forma_nombre = filter_var($_POST['forma_index_nombre'],FILTER_SANITIZE_STRING);}
if (isset($_POST['Marca'])){$Marca = filter_var($_POST['Marca'],FILTER_SANITIZE_STRING);}
if (isset($_POST['Modelo'])){$Modelo = filter_var($_POST['Modelo'],FILTER_SANITIZE_STRING);}
if (isset($_POST['precio_factura'])){$precio_factura = filter_var($_POST['precio_factura'],FILTER_SANITIZE_STRING);}
	

$alerta = false;
$cuota = '239'; 
$url ='http://app.jopi.com.mx/?add-to-cart=18'; 
$urlgoogle = 'goo.gl/abcde';

$mail = new PHPMailer;
	
$mail->CharSet ='UTF-8';	
$mail->setFrom('contacto@jopi.com.mx','JoPi Coverpeer');
$mail->addAddress($email);              
$mail->addReplyTo('contacto@jopi.com.mx', 'JoPi');
$mail->addBCC('contacto@jopi.com.mx');

//attachment
$maxsize = 2 * 1024 * 1024; // 2 MB
$types = array('image/png', 'image/jpeg', 'image/gif'); // allowed mime-types
$filename = $_FILES['foto_fact']['name']; 
$filename_t = $_FILES['foto_fact']['tmp_name']; 
//&& filesize($filename) < $maxsize && in_array(mime_content_type($filename),$types)
if (isset($_FILES['foto_fact']) &&
    $_FILES['foto_fact']['error'] == UPLOAD_ERR_OK) {
    $mail->AddAttachment($filename_t,
                         $filename);
}
//end attachment
$mail->isHTML(true);                                 
$mail->Subject = 'JoPi te da la Bienvenida';
$mail->Body    = '<!doctype html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="IE=edge"><title>Bienvenido a JoPi</title><style type="text/css">html, body{margin: 0 !important;padding: 0 !important;height: 100% !important;width: 100% !important;}*{-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;}.ExternalClass{width: 100%;}div[style*="margin: 16px 0"]{margin: 0 !important;}table, td{mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;}table{border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;}table table table{table-layout: auto;}img{-ms-interpolation-mode: bicubic;}.yshortcuts a{border-bottom: none !important;}a[x-apple-data-detectors]{color: inherit !important;}</style><style type="text/css">.button-td, .button-a{transition: all 100ms ease-in;}.button-td:hover, .button-a:hover{background: #555555 !important;border-color: #555555 !important;}</style></head><body width="100%" height="100%" bgcolor="#EDEDED" style="margin: 0;" yahoo="yahoo"><table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" bgcolor="#EDEDED" style="border-collapse:collapse;"> <tr> <td><center style="width: 100%;"> <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> "Bienvenido" de parte del equipo JoPi</div><div style="max-width: 600px;"><!--[if (gte mso 9)|(IE)]> <table cellspacing="0" cellpadding="0" border="0" width="600" align="center"> <tr> <td><![endif]--> <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="min-width: 600px;"> <tr> <td style="padding: 20px 0; text-align: center"><img src="



https://jopi.com.mx/mail_img/logo_top_horizontal.png

" width="200" height="50" alt="alt_text" border="0"></td></tr></table> <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="100%" style="min-width 600px;"> <tr> <td class="full-width-image" align="center" ><img src="

https://jopi.com.mx/mail_img/hero_img.png

" width="100%" alt="alt_text" border="0" style="width: 100%; max-width: 600px; height: auto;"></td></tr><tr> <td><table cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"> <strong>Gracias '.$forma_nombre.'</strong> <br>
<br>Nos ponemos en contacto porque recientemente entraste a jopi.com.mx. Nos complace informarte que estamos revisando tu petición y te compartiremos una resolución en 48hrs máximo. <br><br>Te invitamos mientras tanto que nos encuentres en redes sociales o visites nuestro sitio web y veas nuestros beneficios<br>
<br><!-- Button : Begin --><table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;"><tr><td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td"><a href="'.$url.'" style="background: #222222; border: 15px solid #222222; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"> Ir a Jopi.com.mx </a></td></tr></table> <br>Algunas de la ventajas y privilegios que obtienes al protegerte con Jopi son <br><br>Es muy fácil de activar: Sólo necesitamos tu factura, datos del beneficiario y el número de IMEI para poder protegerte <br>Recibe el 40% de lo que pagaste en cuotas durantes el año si nadie de tu grupo reporta un incidente <br>Cuotas fijas accesibles que te permiten sentirte más tranquilo</td></tr></table></td></tr><tr> <td bgcolor="#ffffff" align="center" height="100%" valign="top" width="100%"><!--[if mso]> <table cellspacing="0" cellpadding="0" border="0" align="center" width="560"> <tr> <td align="center" valign="top" width="560"><![endif]--> <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:560px;"> <tr> <td align="center" valign="top" style="font-size:0; padding: 10px 10px 30px 10px;"><!--[if mso]> <table border="0" cellspacing="0" cellpadding="0" align="center" width="560"> <tr> <td align="left" valign="top" width="280"><![endif]--> <div style="display:inline-block; max-width:50%; margin: 0 -2px; vertical-align:top; width:100%;" class="stack-column"> <table cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 0 20px;"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;"> <tr> <td style="text-align: center;"><img src="

https://jopi.com.mx/mail_img/apoyo_izq.png

" width="200" alt="" style="border: 0;width: 100%;max-width: 200px;height: auto;" class="center-on-narrow"></td></tr><tr> <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding-top: 10px;" class="stack-column-center"> Emulamos el modelo de “seguro mutualista” que ha tenido gran aceptación en Europa y&nbsp;Asia. </td></tr></table></td></tr></table> </div><!--[if mso]> </td><td align="left" valign="top" width="280"><![endif]--> <div style="display:inline-block; max-width:50%; margin: 0 -2px; vertical-align:top; width:100%;" class="stack-column"> <table cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 0 20px;"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;"> <tr> <td style="text-align: center;"><img src="

https://jopi.com.mx/mail_img/apoyo_der.png

" width="200" alt="" style="border: 0;width: 100%;max-width: 200px;height: auto;" class="center-on-narrow"></td></tr><tr> <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding-top: 10px;" class="stack-column-center"> JoPi nace de la necesidad de crear una nueva forma de proteger tu celular contra robo con&nbsp;violencia. </td></tr></table></td></tr></table> </div><!--[if mso]> </td></tr></table><![endif]--></td></tr></table><!--[if mso]> </td></tr></table><![endif]--></td></tr></table> <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;"> <tr> <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;"><webversion style="color:#4c4c4c; text-decoration:underline; font-weight: bold;"><a style="color:#cccccc; text-decoration:underline; font-weight: bold;" href="https://jopi.com.mx/mail_templates/template_1.html">Ver como página web</a></webversion> <br><br>JoPi<br><span class="mobile-link--footer">Domicilio/ubicación Jopi</span> <br><br><unsubscribe style="color:#888888; text-decoration:underline;"></unsubscribe></td></tr></table><!--[if (gte mso 9)|(IE)]> </td></tr></table><![endif]--> </div></center></td></tr></table></body></html>';
	
$mail->AltBody = 'Gracias'. $forma_nombre .

'Nos ponemos en contacto porque recientemente entraste a jopi.com.mx. Nos complace decirte que sí podemos proteger tu celular contra robo con violencia por XXX mxn mensuales. Si esta oferta te resulta interesante puedes dar click en el siguiente botón para empezar con tu trámite de alta y suscripción 

¡Comenzar! pega en el navegador:' . $urlgoogle . '


Algunas de la ventajas y privilegios que obtienes al protegerte con Jopi son 

Es muy fácil de activar: Sólo necesitamos tu factura, datos del beneficiario y el número de IMEI para poder protegerte 
Recibe el 40% de lo que pagaste en primas si nadie de tu grupo reporta un incidente 
Cuotas fijas accesibles que te permiten sentirte más tranquilo 

';


if(!$mail->send()) {
echo 'Message could not be sent.';
         echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    echo 'Message has been sent';
    }






		
?>

<?php
if ($alerta === true ): 
echo '<div class="alert alert-danger">' . $msg . '</div>';
endif;
	
?>