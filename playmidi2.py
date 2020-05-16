#!/usr/bin/env python

import sys
import mido
import time
from mido import MidiFile

portname = "Roland Digital Piano:Roland Digital Piano MIDI 1 20:0"
filename = sys.argv[1]

with mido.open_output(portname) as output:
    try:
        midifile = MidiFile(filename)
        t0 = False
        length = midifile.length
        for message in midifile.play():
            if(t0 == False):
                t0 = time.time()
            output.send(message)
        print('play time: {:.2f} s (expected {:.2f})'.format(
                time.time() - t0, length))

    except KeyboardInterrupt:
        print()
        output.reset()
