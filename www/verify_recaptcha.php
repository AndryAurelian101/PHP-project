<!DOCTYPE HTML>
<html lang="ro"> 
<HTML>
    <head>
        <title>Register</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="icon" type="image/x-icon" href="img/book.ico">
        <link rel="stylesheet" href="register_style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="index.html" target="_self">
    </head>
    <body>

<?php 

session_start(); 

include "db_connect.php";

 
if(isset($_POST['submit'])){ 
    
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
         
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
            
            $uname = validate($_POST['username']);
            $email = validate($_POST['email']);
            $pass = validate($_POST['password']);
            $pass2 = validate($_POST['password2']);
            

            if (empty($uname) or empty($email) or empty($pass) or empty($pass2)) {
                header("Location: register.php?error=Toate câmpurile(user) trebuie completate");
                exit();
            }
            else{
                $sql = "SELECT * FROM clients_info WHERE username='$uname' OR email='$email'";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['username'] === $uname){
                        header("Location: register.php?error=Există un utilizator cu același username!");
                        exit();
                    }                        
                    if ($row['email'] === $email) {
                        header("Location: register.php?error=email deja folosit!");
                        exit();
                    }
                }
                else{
                    if($pass === $pass2){
                        $query="INSERT INTO clients_info(username, email, password, role) 
                        values('".$uname."','".$email."','".$pass."','user');";
                        $conn->query($query);
                        $_POST = array();
                        header("Location: succes_register.php");
                        exit();
                    }
                    else{
                        header("Location: register.php?error=Parola nu coincide cu cea din câmpul Repetă parola");
                        exit();
                    }
                }
            }
        } 
    }
      else{ 
        
        header("Location: register.php?error=Completeaza reCAPTCHA!");
        exit();
    } 

} 
?>
    </body>
</HTML>