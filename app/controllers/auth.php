<?php

require_once('../app/vendor/autoload.php');

spl_autoload_register(function($class){

    require_once('../app/lib/'.$class.'.php');

});

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class Auth extends Controller{

    public function signin($params=[]){

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: *');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');
        

        if(isset($_POST['ref']) && !empty($_POST['ref']) && $_POST['ref']!='')
        {

            $connectiondb = new DatabaseConnection();

            $userRepo = $this->model('UserRepo');
            $userRepo->connectiondb = $connectiondb;

            $auth=$userRepo->checkUser($_POST['ref']);

            if(!$auth){

                $result=0;

                echo json_encode($result);
                exit();


            }else{

                $result=1;

                echo json_encode($result);
                exit();


                // header ('Location: /projet/public');

            }
            
        }else{

            // $data["em"]="Un des champs requis est vide!!";

            // header ('Location: /cinehall/public/page/signin');

            echo "no ref";

            exit();

        }

    } 



    public function logout($params=[]){

        session_destroy();

        header ('Location: /projet/public/');

    }




    public function signup($params=[]){

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: *');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        if(isset($_POST['email']) && !empty($_POST['email']) && $_POST['email']!=''){
        
        $connectiondb = new DatabaseConnection();

        $userRepo = $this->model('UserRepo');
        $userRepo->connectiondb = $connectiondb;

        $ref = password_hash(rand(), PASSWORD_DEFAULT);


        $success = $userRepo->addUser($ref);


            if (!$success) {


                echo 0;
                exit();

                // $data["em"] = "Impossible d'ajouter l'utilisateur !";

                // $this->view('signupPage',$data);

            } else {


                echo $ref;
                exit();



                // header ('Location: /cinehall/public/page/signin');

            }

        }else{


            echo 404;
            exit();

            // $data["em"]="Un des champs requis est vide!!";

            // $this->view('signupPage',$data);

        }

    } 


    // private function sendConfirmation(){

    //     $mail = new PHPMailer(true);
    //     $email = "fatmuus@gmail.com";
    //     // echo "<div style='display: none;'>";
    //     {
    //         $flag = true;
    //         try {
    //             //Server settings
    //             $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //             $mail->isSMTP();                                            //Send using SMTP
    //             $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    //             $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    //             $mail->Username = 'atman.atharri@gmail.com';                     //SMTP username
    //             $mail->Password = 'jbpdcdxbpzmsfmzn';                               //SMTP password
    //             $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    //             $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //             //Recipients
    //             $mail->setFrom('atman.atharri@gmail.com');
    //             $mail->addAddress($email);
    //             //Content
    //             $mail->isHTML(true);                                  //Set email format to HTML
    //             $mail->Subject = 'no reply';
    //             $mail->Body = 'krjkurgutkrgutk';
    //             $mail->send();
    //             echo 'Message has been sent';
    //         } catch (Exception $e) {
    //             $flag = false;
    //             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    //         }

    //     }
    //     echo "</div>";

    //     die();

    // }

}