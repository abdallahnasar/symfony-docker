
# this project is based on docker container "symfony-docker": https://github.com/dunglas/symfony-docker
it returns most popular repos from github by numbers of stars sorted descending

# To run the project: browse inside symfony-docker folder then run: 
sudo docker-compose up 
(you can change port 80 on docker-compose.yml file if it is already used at your machine)


# To view project code:  

symfony-docker/src

# To run the project:  

> sudo docker-compose exec php /bin/sh
> composer update 

then you can browse:
https://localhost/api/v1/repos
to get top n repos e.g. top 10 repos https://localhost/api/v1/repos?top=10
to get most popular repositories from specific date https://localhost/api/v1/repos?date=1-1-2018
to filter by specific language https://localhost/api/v1/repos?language=Python

e.g: https://localhost/api/v1/repos?top50&date=1-1-2018&language=Python


# To run automated test: 
> sudo docker-compose exec php /bin/sh
> ./vendor/bin/phpunit


# To add a new filter:
add your filter name to filters constants: src/Constant/Filters.php
add your filter class to src/FilterLib folder that should implements FilterInterface and your rules or filter conditions inside filter function 
e.g. src/FilterLib/FilterLanguage.php

  
you can also use another data provider than src/Provider/DataProvider or get larger set of data with the same used github dataprovider by changing parameters of 
src/Constant/EndpointUrls.php GITHUB_ENDPOINT url.



