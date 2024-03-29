<?php 

session_start(); 

include "db_connect.php";

if (isset($_POST['user']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['user']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: log_in_site.php?error=User Name is required");
        exit();

    }else if(empty($pass)){
        header("Location: log_in_site.php?error=Password is required");
        exit();

    }else{
        $sql = "SELECT * FROM clients_info WHERE username='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
                $_SESSION['authenticated'] = true;
                echo "Logged in!";
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];
                if($row['role'] === 'admin')
                    header("Location: admin.php");
                else
                    if($row['role'] === 'manager')
                        header("Location: admin.php");
                    else
                        header("Location: home_e.php");
                exit();

            }else{
                header("Location: log_in_site.php?error=Incorect User name or password");
                exit();

            }

        }else{
            header("Location: log_in_site.php?error=Incorect User name or password");
            exit();

        }
    }

}else{
    header("Location: log_in_site.php");
    exit();

}

?>