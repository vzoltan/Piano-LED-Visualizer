import sys
import mido
import time
from mido import MidiFile

portname = "Roland Digital Piano:Roland Digital Piano MIDI 1 20:0"
filename = sys.argv[1]

output_time_last = 0
delay_debt = 0;
with mido.open_output(portname) as output:
    
    try:
        midifile = MidiFile(filename)
        t0 = False
        length = midifile.length        
        
        for message in midifile:           
            if(t0 == False):
                t0 = time.time()
                output_time_start = time.time()            
            output_time_last = time.time() - output_time_start            
            delay = message.time - output_time_last - float(0.0003) + delay_debt
            
            if(delay > 0):
                time.sleep(delay)
                delay_debt = 0
            else:
                delay_debt += message.time - output_time_last

            output_time_start = time.time()                   
        
            if not message.is_meta:
                output.send(message)

        print('play time: {:.2f} s (expected {:.2f})'.format(
                time.time() - t0, length))

    except KeyboardInterrupt:
        print()
        output.reset()
