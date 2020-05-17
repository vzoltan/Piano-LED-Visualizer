<?php
include "options.php";
$dh = opendir($path);
$files = scandir($path);
closedir($dh);
sort($files);
$REGEX_MID='/.mid$/';
$REGEX_MID_WITH_AUTHOR='/([^-]*)-(.*).mid$/';
if (isset($_GET['author'])){
    $author=strtolower($_GET['author']);
    $firstchar=strtolower($_GET['firstchar']);
    foreach ($files as $file) {
        if(preg_match($REGEX_MID,$file) &&                                                  // mid file
           (
                ($author=="" /*&& !preg_match($REGEX_MID_WITH_AUTHOR , strtolower($file)) */&& $firstchar==strtolower(substr($file,0,1))) ||                  // vagy az author nélkülieket akarjuk listazni es a filenevben nincs author
                (preg_match($REGEX_MID_WITH_AUTHOR , strtolower($file) , $matches) && $matches[1]==$author )   // vagy van author a filenevben és az megegyezik a listazandoval
           )){
            echo '<A href="#" onClick="loadPage(event, \'action\',\'action.php?action=play&song='.$file.'\')">'.$file."</a><BR/>";
        }
    }
}else if (isset($_GET['search']) && $_GET['search']!=""){
    $search=strtolower($_GET['search']);
    foreach ($files as $file) {
        if(preg_match($REGEX_MID,$file) &&                                                  // mid file
            preg_match('/.*'.$search.'.*.mid$/',strtolower($file))){
            echo '<A href="#" onClick="loadPage(event, \'action\',\'action.php?action=play&song='.$file.'\')">'.$file."</a><BR/>";
        }
    }
}else{
    $content = "List of composers and performers:<BR/>";
    $files_lower = array_map( 'strtolower', $files );
    sort($files_lower);
    $prev="-";
    $others="";
    $noartistPrev="AAA";
    foreach ($files_lower as $file) {
        if(preg_match($REGEX_MID,$file)){
            if (preg_match($REGEX_MID_WITH_AUTHOR,$file,$matches)){
                $a = $matches[1];
                if ($a != $prev){
                    $content.='<A href="#" onClick="loadPage(event, \'content\',\'content.php?author='.$a.'\')">'.$a."</a><BR/>";
                    $prev = $a;
                }
            }

            $firstchar = substr($file,0,1);
            if ($firstchar != $noartistPrev){
                $noartistPrev = $firstchar;
                $others .= '<A href="#" onClick="loadPage(event, \'content\',\'content.php?author=&firstchar='.$firstchar.'\')">'.$firstchar."</a>&nbsp;";
            }
            
        }
    }
    echo $others."<br/>".$content;
}

?>
