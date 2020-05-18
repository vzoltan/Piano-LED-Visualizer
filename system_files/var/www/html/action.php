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
                shell_exec("sudo /var/www/html/pm.sh \"".$_GET['song']."\""); 
		$output = shell_exec('ps aux | grep playmidi.py | grep -v grep');
		echo "<pre>$output</pre>";
                break;
		case "whatsplaying":
		$output = shell_exec('ps aux | grep playmidi.py | grep -v grep');
                echo "<pre>$output</pre>";
                break;
                case "time":
                $output = shell_exec('cat /var/www/html/time.txt');
                echo "<pre>$output</pre>";
                break;

        }
    }
?>
