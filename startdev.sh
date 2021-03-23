#!/bin/sh
#Create docker container
docker run -it -d -p 80:80 -p 443:443 -p 3306:3306 --name=dev -v "$(pwd)":/var/www/html coagus/lamp
#Create database
docker exec -i dev mysql -u root < ./mdl/sql/createdb.sql