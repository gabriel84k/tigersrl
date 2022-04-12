<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();

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
            $mail->Body ='<!DOCTYPE html>
            <html class="no-js" lang="zxx">
                <body>
                    <div class="preloader">
                        <div class="preloader-inner">
                            <div class="preloader-icon">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <header class="header navbar-area">
                        <div class="header-middle">
                            <div class="container">
                            <div class="row align-items-center">
                                
                                <div class="col-lg-5 col-md-7 d-xs-none">
                                <!-- Start Main Menu Search -->
                                <h2 class="title">Tiger SRL</h2>
                                <p>Agricultura de Precisión - Enlaces de microondas</p>
                                <!-- End Main Menu Search -->
                                </div>
                                <div class="col-lg-6 col-md-3 col-5">
                                <div class="middle-right-area">
                                    <div class="nav-hotline">
                                    <i class="lni lni-phone"></i>
                                    <h3>
                                        Teléfono/Fax:
                                        <span>(0342) 4535313 - 4560074</span>
                                    </h3>
                                    </div>
                                
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </header>
                    <section class="hero-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-12 custom-padding-right">
                                    <div class="slider-head">
                                        <div class="hero-slider">
                                            <div class="content">
                                                <h2>
                                                <span>Solicitud de Información</span>
                                            
                                                </h2>
                                                <p>
                                                    Nombre : '.$nombre.'
                                                </p>
                                                <p>
                                                    Email : '.$email.'
                                                </p>
                                                <p>
                                                    Telefono : '.$telefono.'
                                                </p>
                                                <p>
                                                    Mensaje : '.$comentario.'
                                                </p>

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </body>
            </html>';
            if ($mail->Send()) { 
                header_remove();
                header("Location: /messaje.html");
                      
            }
            ob_end_flush();
        } catch (Exception $e) {
            header("Location: /{$mail->ErrorInfo}");
           
        }
        
    } else {
        $errors = $resp->getErrorCodes();
        header('Location: http://tigersrl.com.ar/');
        $respuesta = "ERROR al enviar el msj";
    }
?>

