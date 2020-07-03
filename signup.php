<?php 
    require "head.php";
?>
<style>
  html, body {
  
  margin: 0;
  height: 100%;
  color: white;
  background-color: rgb(115, 115, 115);
  border: 0;
  border-left: 0;
  margin-left: 0;
  overflow: hidden;
  font-family: "Work sans", Arial;
  min-width: 100%;

}
</style>
<body class="fullbackground">
<?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == 'emptyfields') {
              echo '<p class="error-text">Töltsd ki az összes mezőt!</p>';
            }
            else if ($_GET['error'] == 'invalidmail'){
              echo '<p class="error-text">Hibás emailcím</p>';
            }
            else if ($_GET['error'] == 'invalidusername'){
              echo '<p class="error-text">Hibás felhasználónév</p>';
            }
            else if ($_GET['error'] == 'passwordcheck'){
              echo '<p class="error-text">A jelszavak nem egyeznek</p>';
            }
            else if ($_GET['error'] == 'usertaken'){
              echo '<p class="error-text">Foglalt felhasználónév</p>';
            }
          }
          

       ?>
          <div class ="form_middle">

            <form  action="core/signup.php" method="POST">
                <input type="text" name="username" placeholder="Felhasználónév">
                <input type="text" name="mail" placeholder="E-mail cím">
                <input type="password" name="pwd" placeholder="Jelszó">
                <input type="password" name="pwd-repeat" placeholder="Jelszó megerősítése">
                <button class="login_button" type="submit" name="signup-submit">Regisztráció</button>
            </form>
            <a href="login.php" class="link">Vissza a bejelentkezésre</a>
        </div>


  </body>