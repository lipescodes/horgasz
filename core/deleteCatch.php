<?php 
    require "core_functions.php";

    if (isset($_POST['delete-catch'])) {
        $id =  $_POST['id'];

        deleteCatch($id);

        header("Location: ../diary.php?delete=success");
        exit();

    }

?>