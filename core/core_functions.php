<?php

// Felhasználók betöltése fájlból
function loadUsers() {
    $file = fopen("users.txt", "r");
    $users = [];
    while (($line = fgets($file)) !== false) {
        $users[] = unserialize($line);
    }
    fclose($file);
    return $users;
}

// Új elhasználó hozzáfűzése a fájl végéhez
function saveUser($user) {
    $file = fopen("users.txt", "a");
    fwrite($file, serialize($user)."\n");
    fclose($file);
}

function asd(){
    echo 'ASD';
}

/* FOGÁSOK BETÖLTÉSE FÁJLBÓL */

/* ITT rengeteget szívtam, mert csak simán catch.txt útvonalat adtam meg
    ami jó is lenne ha a core-on belül hívnám meg. De mivel nekem a "VIEW"oknál kell ezértz
    módosítani kellet az útvonalat. 
*/
function loadCatchs($user){   
    $file = fopen("core/catch.txt", "r");

    $catch = [];
    while (($line = fgets($file)) !== false) {
        if (strlen($line) > 1) {
            $line = unserialize($line);
    
            if($line['user'] == $user){
                $catch[] = $line; 
            }  
        }
         
    }
    fclose($file);
    return $catch;
}
/* A figás file hosszát kérem le és id-nak hasnzálom majd
 a törlés miatt
  */
function catchSize(){
  
    return intval(filesize("catch.txt")) +1;
}
/* FOGÁS MENTÉSE FÁJLBÓL */

function saveCatch($catch){
    $file = fopen("catch.txt", "a");
    fwrite($file, serialize($catch)."\n");
    fclose($file);
}

function deleteCatch($id){
    /* Kiolvasok minden tartalmat */
    $file = fopen("catch.txt", "r"); 

    $catch = [];
    while (($line = fgets($file)) !== false) {
        $line = unserialize($line);
        if($line['id'] != intval($id)){
            $catch[] = $line; 
        }
    }
    fclose($file);
    /* Törlöm a tartalmát */
    ftruncate(fopen("catch.txt", "r+"), 0 );
    fclose($fp);
    /* visszatöltöm a maradékot */
    $file = fopen("catch.txt", "a");
    foreach ($catch as $c) {
        
        fwrite($file, serialize($c)."\n");
    }
    fclose($file);
}

/* Összes tilalom bekérése */
function loadFishs() {
    /* Mivel nem a core mappából hívom meg figyelek az útvonalte */
    $file = fopen("core/bans.txt", "r");
    $bans = [];
    while (($line = fgets($file)) !== false) {
        $bans[] = unserialize($line);
    }
    fclose($file);
    return $bans;
}


// Blog bejegyzések betöltése fájlból
function loadPosts() {
    $file = fopen("blog.txt", "r");
    $posts = [];
    while (($line = fgets($file)) !== false) {
        $posts[] = unserialize($line);
    }
    fclose($file);
    return $posts;
}

// Blog bejegyzések kimentése fájlba
function savePosts($posts) {
    $file = fopen("blog.txt", "w");
    foreach ($posts as $post) {
        fwrite($file, serialize($post)."\n");
    }
    fclose($file);
}

// Új blog bejegyzés mentése
function savePost($post) {
    // Betöltjük az összeset
    $posts = loadPosts();
    // Megkeressük az eddigi legnagyobb azonosítót
    $id = 0;
    foreach ($posts as $p) {
        if ($p["id"] > $id) {
            $id = $p["id"];
        }
    }
    // Az eddigi legnagyobbnál eggyel nagyobb azonosítót kap az új bejegyzés
    $post["id"] = $id+1;
    // Beszúrjuk a tömb elejére az újat
    array_unshift($posts , $post);
    // Kimentjük az összeset
    savePosts($posts);
}

// Bejegyzés törlése azonosító alapján
function deletePost($id) {
    $posts = loadPosts();
    $posts2 = [];
    // Előállítunk egy olyan tömböt, amiben nincs benne a törölni kívánt azonosító, majd kimentjük
    foreach ($posts as $p) {
        if ($p["id"] != $id) {
            $posts2[] = $p;
        }
    }
    savePosts($posts2);
    // TODO: ehhez a bejegyzéshez tartozó kommentek törlése
}

// Bejegyzés betöltése azonosító alapján
function loadPost($id) {
    $posts = loadPosts();
    foreach ($posts as $p) {
        if ($p["id"] == $id) {
            return $p;
        }
    }
    // Ha nem találtunk ilyen bejegyzést null-al térünk vissza
    return null;
}

// Komment mentése adott bejegyzéshez
function saveComment($id, $text, $felhasznalo) {
    $file = fopen("comments.txt", "a");
    fwrite($file, serialize([
            "id" => $id,
            "text" => $text,
            "felhasznalo" => $felhasznalo,
        ])."\n");
    fclose($file);
}

// comments betöltése adott bejegyzéshez
function commentsLoad($id) {
    $file = fopen("comments.txt", "r");
    $comments = [];
    while (($line = fgets($file)) !== false) {
        $k = unserialize($line);
        if ($k["id"] == $id) {
            $comments[] = $k;
        }
    }
    fclose($file);
    return $comments;
}

/* Hibaüzenet megjelenítése */

