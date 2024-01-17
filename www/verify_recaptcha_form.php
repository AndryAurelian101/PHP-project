<?php 
$returnMsg = ''; 
 
if(isset($_POST['submit'])){ 
    
	// Form fields validation check
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])){ 
         
        // reCAPTCHA checkbox validation
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secret_key = '6LcY3DUpAAAAAIkZXeIeHeHrGh1dc1-uy_T1IxY_'; 
             
            // reCAPTCHA response verification
            $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
            
            // Decode reCAPTCHA response 
            $verify_response = json_decode($verify_captcha); 
             
            // Check if reCAPTCHA response returns success 
            if($verify_response->success){ 
                
                $name = $_POST['name']; 
                $email = $_POST['email']; 
                $phone = $_POST['phone'];
				$message = $_POST['message'];
             
                #email Gmail
				require_once('class.phpmailer.php');
				require_once('mail_config.php');
				
                $mailBody = "Your Response: " . "<br>";
				$mailBody .= "User Name: " . $name . "<br>";
				$mailBody .= "User Email: " . $email . "<br>";
				$mailBody .= "Phone: " . $phone . "<br>";
				$mailBody .= "Message: " . $message . "<br>";
				
				$mail = new PHPMailer(true); 

				$mail->IsSMTP();

				try {
				 
				  $mail->SMTPDebug  = 3;                     
				  $mail->SMTPAuth   = true; 

				  $toEmail='andry-library@alwaysdata.net';
				  $nume='PHP Project';
                
				  $mail->Host       = "smtp-andry-library.alwaysdata.net";
				  $mail->Port       = 587;
                  $mail->SMTPSecure = "tls"; 
                  $mail->SetFrom($username, 'andry-library@alwaysdata.net');  //datele reale ale contului utilizat sa transmita email-ul; probabil @s.unibuc.ro 
				  $mail->Username   = $username;
				  $mail->Password   = $password;
				  $mail->AddReplyTo('andry-library@alwaysdata.net', 'Form User');
				  $mail->AddAddress($toEmail, $nume);
				  $mail->addBcc($email);
				  $mail->Subject = 'Formular contact';
				  $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
				  $mail->MsgHTML($mailBody);
                  
				  $mail->Send();
				  
                  $returnMsg = 'Your message has been submitted successfully.'; 
				  header('Location: log_in_site.php');
                  exit();
                }
                 catch (phpmailerException $e) {
												  echo $e->errorMessage(); //error from PHPMailer
												}
				 
            } 
        }
		  else{ 
            
			$returnMsg = 'Please check the CAPTCHA box.'; 
        } 
    }
	 else
			{ 
				$returnMsg = 'Please fill all the required fields.'; 
			} 
} 
echo $returnMsg;
?>