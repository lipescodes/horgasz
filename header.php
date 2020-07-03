<?php
  session_start();
  require "head.php";
  /* AZ headerben az aktív gombok megalkotásához lekérem az oldal nevét
  majd levágom róla a .php stringet
  ezalapján meglesz melyik oldalon vagyok és az oldal neve alapján meghatározom a 
  css classt
    */
  $pageName = basename($_SERVER['PHP_SELF']);
  $pageName = substr($pageName, 0, -4);
  
 ?>
 <body>
  <header class="navbar navbar-fixed-top">
    <div class="topnav">
      <div class="left-nav">

        <?php
        if (isset($_SESSION['username'])) {
          echo "<p>Üdvözöllek ".$_SESSION['username']."</p>";
          /* echo '<br><form  action="core/logout.php" method="POST">
          <button class="mybutton" type="submit" name="logout-submit">Kijelentkezés</button>
          </form>'; */
        }
        else {
          header("Location: login.php");
          exit;
        }
        ?>
      </div>
      <div class="right-nav">
       <!--  <p ><a class="link" type="submit" name="logout-submit">Blog</a></p> -->
       <!-- minden classba beteszek egy feltételt
        ha az oldal neve az ami ott megvan határozva megkapja az active classt
      -->
        <p ><a class="link <?php echo $pageName == 'diary'? 'active' : ''  ?>" href="diary.php" name="diary">Fogásnapló</a></p>
        <p ><a class="link <?php echo $pageName == 'bans'? 'active' : ''  ?>" href="bans.php" name="waters">Tilalmak</a></p>
        <p ><a class="link <?php echo $pageName == 'sizes'? 'active' : ''  ?>" href="sizes.php" name="waters">Méretek</a></p>
        <p><a class="link" href="core/logout.php" type="submit" name="logout-submit">Kijelentkezés</a></p>

      </div>

  
 
  
  </div>
  </header>
