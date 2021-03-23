@ECHO OFF
ECHO CREATE CONTAINER...
docker run -it -d -p 80:80 -p 443:443 -p 3306:3306 --name=dev -v %CD%:/var/www/html coagus/lamp
PING 127.0.0.1 -n 5 -w 1000 > NUL
ECHO CREATE DATA BASE...
docker exec -i dev mysql < %CD%\mdl\sql\createdb.sql
ECHO Finished!... go to http://localhost