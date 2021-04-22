<?php
header('Content-type:application/json');
require_once "../vendor/autoload.php";
use Fbdn\Mailer\PhpMailer;
use Fbdn\Mailer\SMTP;
use Fbdn\Utilities\Utility;
use Fbdn\Config\CartConfig;
use Fbdn\Exceptions;
use Fbdn\Exceptions\UserNotFoundException;
use Fbdn\Exceptions\PhpMailerException;
$db = new Utility();
$message = array();
if(isset($_POST['reset']) && $_POST['reset'] == 1){
    try{
        $newPassword = $db->resetPassword($_POST['email']);
        $mail = new PHPMailer(true);
        $mail->isSMTP();
		//$mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
		//$mail->Debugoutput = 'html';
        $mail->Host = "smtps.aruba.it";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        //Provide username and password
        $mail->Username = "direzione@functionalmove.it";
        $mail->Password = "Lorenzo2014";
        //Set TCP port to connect to
        $mail->Port = 465;
        $mail->isHTML(true);
        //$mail->setFrom('noreply@walkingprogram.net','Luca Piancastelli');
        $mail->Body='<html>
                     <body>
                        <table cellpadding="10" style="width:600px;border-color:#666">
                            <tr><td><img src="https://www.functionalmove.it/img/logos/logo_email.png"></td></tr>
                            <tr><td>Abbiamo Resettato la tua Password</td></tr>
                            <tr><td>La tua Nuova Password: </td><td>'.$newPassword.'</td></tr>
                            <tr><td>Potrai Cambiarla dal Tuo Profilo</td></tr>
                            <tr><td>A Presto</td></tr>
                            <tr></tr>
                            <tr><td>Direzione Functional Move</td></tr>
                            <tr><td>ASD Functional Move <br>
          Via Anita Garibaldi, 2/d - 47521 Cesena (FC)<br>
          <a href="tel:+39057461056">+39 0547 613056</a><br>
          <small>P. IVA: 04181770407<br>CODICE ISCRIZIONE REGISTRO CONI 237764 </small><br>
          <a href="privacy.php" class="text-xs rosso">Privacy Policy</a></td></tr>

                        </table>
                    </body>
                  </html>
';
        $mail->From = 'noreply@walkingprogram.net';
        $mail->FromName = 'Luca Piancastelli';
        $mail->Subject = "Reset Password walkingprogram.net ";
        $mail->addAddress($_POST['email']);

        $mail->send();
        echo json_encode(array('success'=>true,'msg'=>'Abbiamo Spedito la Password temporanea a '.$_POST['email']));

    }catch(PhpMailerException $ex){
        echo json_encode(array('success'=>false,'msg'=>'Mailer Error: '.$ex->getMessage()));

    }
    catch(UserNotFoundException $ex){

        echo json_encode(array('success'=>false,'msg'=>'User Error: '.$ex->getMessage()));

    }catch(\Exception $ex){

        echo json_encode(array('success'=>false,'msg'=>'Exception Error: '.$ex->getMessage()));
    }



}
?>