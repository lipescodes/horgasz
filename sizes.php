<?php 
    require "header.php";
    require "core/core_functions.php";
    require "lang.php";
    $allFish = loadFishs();
    
    
    function getSizes(){
        $sizeList = [];
        $allFish = loadFishs();
        foreach ($allFish as $fish) {
            
            if(isset($_POST[$fish['fish-name']]) &&!empty($_POST[$fish['fish-name']])){
                $sizeList[] = $fish;
            }
        }
        return $sizeList;
    }

    
    
    
?>

<h2 class="text-center"> Jelöld be milyen halakat fogtál?</h2>

<div class="catchList" style="text-align:center;">
    <form action="sizes.php" method="POST">  
        <?php 
       
        foreach($allFish as $fish){
              echo '<label style="font-size: 20px;"for="'.$fish['fish-name'].'"> '.$namesHun[$fish["fish-name"]].'</label>
              <input type="checkbox" id="'.$fish['fish-name'].'" value="'.$fish['fish-name'].'" name="'.$fish['fish-name'].'"><br>';
            }
        
        ?>
        <br>
         
        <button class="login_button" type="submit" name="size-submit">Tilalmak lekérése</button>        
    </form>
<div>

<h1 class="text-center"> Méretkorlátok a jelölt halakra:</h1>

<div class="catchList" style="text-align:center;">
            <hr>
            <table class="center" style="width:75%">
            <tr>
                <th class="th_img"></th>
                <th>Hal fajta</th>
                <th>Minimum méret</th>
                

            </tr>

            <?php 
                if(isset($_POST['size-submit'])){
                 
                    $sizeList = getSizes();

                    foreach ($sizeList as $size) {
                    echo '<tr>
                        <th style="max-width: 200px;"><img src="img/'.$size['fish-name'].'.jpg"></th>
                        <th>'.$namesHun[$size['fish-name']].'</th>
                        <th>'.$size['fish-length'].'</th>
                      
                    </tr>';
                    }
 
                }
            ?> 
            </table>
            
        </div>
    </div>


<?php 
    require "footer.php";
?>