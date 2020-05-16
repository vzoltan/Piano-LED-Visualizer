<?php
    if (isset($_GET['action'])){
        echo $_GET['action'];
        switch ($_GET['action']){
            case "stop":
                shell_exec("sudo /var/www/html/killpm.sh");
                break;
            case "reboot":
                shell_exec("sudo reboot");
                break;        
            case "pianoled":
                shell_exec("sudo service pianoled restart");
                break;
            case "btmidi";
                shell_exec("sudo service btmidi restart");
                break; 
            case "play":
                shell_exec("sudo /var/www/html/pm2.sh \"".$_GET['song']."\""); 
                break;
        }
    }
?>
