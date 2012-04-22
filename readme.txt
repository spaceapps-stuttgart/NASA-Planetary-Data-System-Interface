Receiving data from horizons.jpl.nasa.gov

getdata.php
Receive data from the telnet server. The file talks with the telnet, downloads the file which is saved on the horizons ftp server. This file is then parsed to generate a file with positions (adding velocities is already implemented, but not activ).

list_of_objects.txt
A few objects for which data could be required from horizons.

plotdata.m
A file for Octave / Matlab to plot the data which is received from horizons. It plots a 3d view of the trajectory. It could also plot the velocity in a seperate figure.

fromjason.php
Receive data from http://nasa.apphb.com/coords/{ID}. This file does the same like getdata.php, only downloading json data and not talking telnet.

tmp.data
Some sample data generated from getdata.php

