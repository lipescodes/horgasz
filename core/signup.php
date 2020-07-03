<?php
    require "core_functions.php";

  if (isset($_POST['signup-submit'])) {
   

    $username = $_POST['username'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
 
    /* MEzők figyelése, hogy van e benne érték, ha nincs visszadob az oldalra és a ,,linkkel"
        küldi a hibaüzenet kódját amint majd a signup.php-n a $_GET beolvas, változókat is ad át, de azt nem kezeltem 
        le. Csak egyszerű üzenetek jelennek meg. 
    */
    if (empty($username) || empty(  $email) || empty($password) || empty($passwordRepeat)) {
      header("Location: ../signup.php?error=emptyfields&username=".$username."&email=".$email);
      exit();
    }
    
    /* email formátum ellenőrzése */
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../signup.php?error=invalidmail&username=".$username);
      exit();
    }
    /* felhasználó formátum ellenőrzése csak szám és betű lehet (Regex használata REgex => "/^[a-zA-Z0-9]*$/") <- ez annyit tesz hogy csak szám és betű lehet benne   */
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
      header("Location: ../signup.php?error=invalidusername&username=".$email);
      exit();
    }
    /* jelszavak egyezőségének vizsgálata */
    else if ($password !== $passwordRepeat ) {
      header("Location: ../signup.php?error=passwordcheck&username=".$username."&mail=".$email);
      exit();
    }
    else {
        
        $allUser = loadUsers();
        $stmt = mysqli_stmt_init($conn);
        $checkUser = false;
        foreach($allUsers as $u){
            if($u['username'] == $username){
                $checkUser = true;
                break;
            }
        }

        if ($checkUser) {
            header("Location: ../signup.php?error=usertaken&mail".$email); //username taken
            exit();
        }
        else {

            saveUser([
                "username" => $username,
                "email" => $email,
                "password" => $password,
                
            ]);
            
            header("Location: ../login.php?signup=success");
            exit();
            }
        }
      
    }
  
  else {
    header("Location: ../signup.php");
    exit();
  }
