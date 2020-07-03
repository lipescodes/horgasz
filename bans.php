<?php 
    require "header.php";
    require "core/core_functions.php";
    require "lang.php";

    /* A txt beolvasásakor nem tudta kezelni a php az ékezetes karaktereket mivel 14 névről van szó 
        manuálisan megadom, amúgy az adatbázis karakterkódolását kellet volna módosítani txt nem találtam hogy ez hogy néz ki 
    */


    function getBans(){
        $allBans = loadFishs();
        /* Bekérem a postolt dátumot 
            és levágom végét mert csak a hónap és nap kell
        */
        $selectedDate = dateFormat(substr($_POST['date'], 5)); 
        
        /* végigmegyek az összes tilalmon és ha a dátum tilalom idején van akkor pusholomn a $banlistbe */
       // var_dump($allBans);
        $bansList = [];
        foreach ($allBans as $ban) {
            /* echo $selectedDate.'<br>';
            echo dateFormat($ban['date-from']).'<br>'; 
            echo ($selectedDate >= dateFormat($ban['date-from'])).'<br>'; 
            echo ($selectedDate <=dateFormat($ban['date-to'])).'<br>'; 
            echo dateFormat($ban['date-to']).'<hr>'; */


            /* Ellenőrzöm hogy a dátumtól kisebb-e mnint a dátum ig */
            if (dateFormat($ban['date-from']) < dateFormat($ban['date-to'])) {
                if($selectedDate >= dateFormat($ban['date-from'])  &&  $selectedDate <=dateFormat($ban['date-to'])){  
                    $bansList[] = $ban;
                }
            }else{
                if ($selectedDate >= dateFormat($ban['date-from'])  ||  $selectedDate <=dateFormat($ban['date-to'])) {  
                    $bansList[] = $ban;
                }
            }
        }
        return !empty($bansList) ? $bansList : null;
    }
    /* Formázom és inté alakítom a dátumot  */
    function dateFormat($date){
        return intval(substr($date, 0, 2).substr($date,3));
    }

  
?>

<h2 class="text-center"> Válaszd ki mikor mennél horgászni:</h2>
   <!-- itt csak megjelenítés lesz nem ide oda mentés ezér nem hoztam
létre külön fájlt, hanem itt oldom meg a lista adatok beszerzését. -->
    <form action="bans.php" method="POST">  
        <input type="date" id="date" name="date" />
         
        <button class="login_button" type="submit" name="bandate-submit">Tilalmak lekérése</button>        
    </form>


<h1 class="text-center"> Tilalmak az adott időpontra:</h1>

<div class="catchList" style="text-align:center;">
            <hr>
            <table class="center" style="width:75%">
            <tr>
                <th class="th_img"></th>
                <th>Hal fajta</th>
                <th>Dátum -tól</th>
                <th>Dátum -ig</th>

            </tr>

            <?php 
                if(isset($_POST['bandate-submit'])){
                    $bansList = getBans();
                    if ($bansList) {
                      
                        foreach ($bansList as $ban) {
                        echo '<tr>
                            <th style="max-width: 200px;"><img src="img/'.$ban['fish-name'].'.jpg"></th>
                            <th>'.$namesHun[$ban['fish-name']].'</th>
                            <th>'.$ban['date-from'].'</th>
                            <th>'.$ban['date-to'].'</th>
                        </tr>';
                        }
                    }else{
                        echo '<h1>Nincs tilalom a választott dátumon</h1>';
                    }
 
                }
            ?> 
            </table>
            
        </div>
    </div>


<?php 
    require "footer.php";
?>