(HOME=/home/pi /usr/bin/python /home/pi/Piano-LED-Visualizer/playmidi.py '/home/pi/Piano-LED-Visualizer/Songs/'$1 'Roland Digital Piano:Roland Digital Piano MIDI 1 20:0' >/dev/null )&
echo $! > /var/www/html/vpid
sudo service pianoled restart

