<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$secret = '6LdYiFofAAAAADcMYH9XlQHW__vB_9z3Ii_JsMC3';
$gRecaptchaResponse = $_POST['g-recaptcha-response'];
$remoteIp =$_SERVER['REMOTE_ADDR'];
        
    require_once 'autoload.php';
    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    $resp = $recaptcha->setExpectedHostname('tigersrl.com.ar')
                  ->verify($gRecaptchaResponse, $remoteIp);
    if ($resp->isSuccess()) {
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'wo41.wiroos.host';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contacto@tigersrl.com.ar';                     //SMTP username
            $mail->Password   = 's^(i}YXqR85y';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $email = trim($_POST['email']);
            $nombre = trim($_POST['name']);
            $telefono = trim($_POST['phone']);
            $comentario = trim($_POST['message']);

            $mail->setFrom('contacto@tigersrl.com.ar', 'Contacto');
            $mail->addAddress('contacto@tigersrl.com.ar', 'Info');     //Add a recipient
          
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Solicito Información';
            $mail->Body ='<section class="section blog-single">
                    <div class="container">
                        <div class="row" id="19/08/2015">
                        <div class="col-lg-12 col-md-12 col-12 mb-5">
                            <div class="single-inner">
                            <div class="post-details">
                                <div class="main-content-head">
                                <div class="meta-information">
                                    <h2 class="post-title">
                                    <a href="#">Airtracker Versión 10.70.07B (19/08/2015).</a>
                                    </h2>
                                </div>
                                <div class="detail-inner">
                                    <p>
                                    Está disponible la versión 10.70.07 B para el banderillero
                                    satelital Airtracker. La misma incluye una corrección
                                    importante para solucionar problemas de fecha de algunos
                                    modelos de GPS:
                                    </p>
                                    <h3>Novedades</h3>
                                    <ul class="list">
                                    <li>
                                        <i class="lni lni-checkmark-circle"></i> Ver novedades
                                        de la versión 10.70.06
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle"></i> Ver novedades
                                        de la versión 10.60.04
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle"></i> Ver novedades
                                        de la versión 10.60.02
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle"></i> Ver novedades
                                        de la versión 10.60.00B
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle"></i> Ver novedades
                                        de la versión 10.50.05
                                    </li>
                                    </ul>
                                    <h3>Novedades</h3>
                                    <p>
                                    Version 10 en adelante ya no maneja mas la tarjeta
                                    loggycard
                                    </p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>';
           
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
           
            if ($mail->Send()) { 
                header("Location:/messaje.html");//echo "Message Sent!";            
            }
        } catch (Exception $e) {
            header("Location: /{$mail->ErrorInfo}");
           
        }
        
    } else {
        $errors = $resp->getErrorCodes();
        header('Location: http://tigersrl.com.ar/');
        $respuesta = "ERROR al enviar el msj";
    }
?>



