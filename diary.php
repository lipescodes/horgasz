<?php
require "header.php";
require "core/core_functions.php";
require "lang.php";
//session_start();
$allCatch = loadCatchs($_SESSION['username']);
?>



    <h2 class="text-center">Fogás hozzáadása</h2>
    
    <div >
    <hr><br>
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'emptyfields') {
              echo '<p class="error-text">Töltsd ki az összes mezőt!</p>';
            }
        }else if(isset($_GET['addCatch']) && $_GET['addCatch'] == 'success'){
            echo '<p class="succes-text" style="margin-top: 0px;">A fogás sikeresen rögzítve!</p>';
        }   

    ?>        
        <form action="core/saveCatch.php" method="POST">
        <input  type="text" name="location" placeholder="Írd be a vízterületet"/> 
        <select id="fishtype" name="fishlist">
            <option value="0">-- Válasz halfajtát -- </option>
            <?php
                $allFish = loadFishs();
                foreach ($allFish as $fish) {
                    echo '<option value="'.$fish['fish-name'].'">'.$namesHun[$fish["fish-name"]].'</option>';
                }
            ?>
        </select>
        
        <input type="date" id="date" name="date" />
        
        <input type="number" name="weigth" step="0.1" min="0" max="150" placeholder="Add meg a hal súlyát"/> 
        <button class="login_button" type="submit" name="add-catch-submit">Fogás hozzáadása</button>        
        </form>
        
        <hr>
        
        
        <div class="catchList" style="text-align:center;">
            <h1 class="text-center">Fogások listázása</h1>
            <hr>
            <table class="center" style="width:90%">
            <tr>
                <th class="th_img"></th>
                <th>helyszín</th>
                <th>Hal fajta</th>
                <th>Dátum</th>
                <th>Súly</th>
                <th style='width: 15%; min-width: 50px;'></th>
            </tr>

            <?php 
              foreach ($allCatch as $catch) {
                echo '<tr>
                <th ><img src="img/'.$catch['fishlist'].'.jpg"></th>
                <th>'.$catch['location'].'</th>
                <th>'.$catch['fishlist'].'</th>
                <th>'.$catch['date'].'</th>
                <th>'.$catch['weigth'].' kg</th>
                <th>
                    <form class="diaryform" action="core/deleteCatch.php" method="POST">
                      <input type="hidden" name="id" value="'.$catch['id'].'">
                      <button class="delete-button text-center" style="color: red; border-color:red;" type="submit" name="delete-catch">Fogás törlése</button>
                    </form>
                </th>
            </tr>';
              }
              
            ?> 
            </table>
            
        </div>
    </div>

<?php 
require "footer.php";
?>