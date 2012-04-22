% This lines will parse a data file, format:
% x y z
% -0.84730122724953 -0.54116616567633 1.656286703084E-5
% -0.84692661511026 -0.54177307476564 1.6604293650821E-5
% 
% This will be displayed in a 3d plot


AU = 149597870.691*10^3;
day = 86400.0;

% load and display data
C = load('tmp.data');

pos = C(:,1:3)*AU;
%vel = C(:,4:6)/day*AU;


plot3(pos(:,1),pos(:,2),pos(:,3));

%figure;
%vel = (vel*vel').^.5;
%plot(vel(:,1));