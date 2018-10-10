## Micro-phalcon

### Base project for REST API's implementing [Phalcon](https://phalconphp.com/) framework

Loosely based on https://github.com/cmoore4/phalcon-rest

### Installation

    docker-compose up -d

 url -> *localhost:8080/v1/test*

Check for containers with `docker ps` there should be 3 of them: nginx, phpfpm and mongodb.
 Default ports:
  

 - web-service is 8080
 - mongo 27017

To run unit tests:

    docker run -v $(pwd):/var/www/test-service --rm matricali/phalcon:7.2-stretch-3.4.0-xdebug phpunit -c /var/www/test-service/phpunit.xml