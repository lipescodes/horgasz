<?php
 session_start();
require "core_functions.php";


if (isset($_POST['add-catch-submit'])) {
    $user = $_SESSION['username'];
    $location = $_POST['location'];
    $fishlist = $_POST['fishlist'];
    $date = $_POST['date'];
    $weigth = $_POST['weigth'];

       
    if (empty($location) || empty($fishlist) || $fishlist == "0" || empty($date) || empty($weigth)) {
        header("Location: ../diary.php?error=emptyfields");
        exit();
    }else {
      saveCatch([
        "id" => catchSize(),
        "user" => $user,
        "location" => $location,
        "fishlist" => $fishlist,
        "date" => $date,
        "weigth" => $weigth,
        ]);      
        header("Location: ../diary.php?addCatch=success");
        exit();
    }

}else{
  header("Location: ../diary.php");
  exit();
}
    
  
