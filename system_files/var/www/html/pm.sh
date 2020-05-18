sudo kill -9 `cat /var/www/html/vpid`
(HOME=/home/pi /usr/bin/python /var/www/html/playmidi.py '/home/pi/Piano-LED-Visualizer/Songs/'$1 >/var/www/html/time.txt )&
#(HOME=/home/pi /usr/bin/python /home/pi/Piano-LED-Visualizer/playmidi.py '/home/pi/Piano-LED-Visualizer/Songs/'$1 >/dev/null )&
echo $! > /var/www/html/vpid
sudo service pianoled restart

