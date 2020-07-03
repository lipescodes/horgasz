<?php

require "core_functions.php";


if (isset($_POST['login-submit'])) {


  $username = $_POST['username'];
  $password = $_POST['pwd'];


  if(empty($username)) {
    
    header("Location: ../login.php?error=emptyUserfields");
    exit();
  }else if (empty($password)) {

    header("Location: ../login.php?error=emptyPwdfields");
    exit();
  }else {
    $allUsers = loadUsers();
    foreach($allUsers as $u){
        if($u['username'] == $username){
            $user = $u;
            break;
        }
    }
   



    if (!is_array($user) || !isset($user) || empty($user)) {
      header("Location: ../login.php?error=usererror");
      exit();
    }
   
    if ($user['password'] != $password) {
        header("Location: ../login.php?error=passworderror");
        exit();
    }else{
        
        session_start();
        //$_SESSION['userId'] = $row['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../index.php?login=success");
        exit(); 
    }
/* 



      mysqli_stmt_bind_param($stmt, "ss", $username, $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['password']);

        var_dump($users);die();

        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['userId'] = $row['id'];
          $_SESSION['userUID'] = $row['username'];
          header("Location: ../index.php?login=success");
          exit();

        }
        else {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      } */
    }
}else {
    header("Location: ../index.php");
    exit();
}
