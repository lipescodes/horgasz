<?php 
  require "head.php";
?> 
<!-- A LOGIN OLDALON ÉS A SIGNUP OLDALON IS AZÉRT VAN KÜLÖN 
    BEILLESZTVE A HEADER RÉSZ, mert abba tettem bele a session kezelést. Itt még nincs
    rá szügség és csak galibát okoznai. Igazi így duplikáltam a kódot, de egyszerűbb :) 
-->

<!-- EZ nagyon csúnya így, de mievel a head máshol jön és itt még relatív
nem sok design van így egyszerűbb hogy ne mozdujon el ha előugrik a hibaüzenet
ugyan ez szükséges a regisztrációnál is
-->
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
  <body class="fullbackground" >
  <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == 'emptyUserfields') {
              echo '<p class="error-text">Felhasználó mező üres!</p>';
            }
            else if ($_GET['error'] == 'emptyPwdfields'){
              echo '<p class="error-text">Jelszó mező üres!</p>';
            }
            else if ($_GET['error'] == 'usererror'){
              echo '<p class="error-text">Felhasználó nem található!</p>';
            }
            else if ($_GET['error'] == 'passworderror'){
              echo '<<p class="error-text">Hibás jelszó!</>';
            }
          }else if(isset($_GET['signup'])){
            if ($_GET['signup'] == 'success'){
              echo '<p class="succes-text">Sikeres regisztráció!</p>';
            }
          }
          ?>
          <div class ="form_middle">

            <form  action="core/login.php" method="POST">
              <input  type="text" name="username" placeholder="Felhasználónév">
              <input type="password" name="pwd" placeholder="Jelszó">
              <button class="login_button" type="submit" name="login-submit">Bejelentkezés</button>
            </form>
            <a href="signup.php" class="link">Regisztráció</a>
        </div>


  </body>
