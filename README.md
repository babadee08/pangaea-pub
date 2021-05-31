# Pangaea Test
___

## Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)

### Design Decision
- This is a simple publisher service. I used the in built Event system in Laravel to handle the Notification sending. 
I'm sure the Notification Service in Laravel could do the same thing directly.
- I also used the database for the queue management, other alternative for that could be Redis OR Amazon SQS.
- The Test coverage is a bit limited, I wrote mostly integration tests as that would test most of the components of the 
system in the request lifecycle.
- Logging to is a bit limited but could have been improved also. 

The table below shows the available endpoints.

| Verb | Path | Action
|------|------|------
| GET  | / |  Framework info
| POST | /subscribe/{topic} | Subscribe to a topic
| POST | /publish/{topic} | Publish data to a topic

Setting up your development environment on your local machine :
```bash
$ git clone git@github.com:babadee08/pangaea-pub.git
$ cd pangaea-pub
$ cp .env.example .env
$ composer install
$ php artisan migrate --seed
```

## Other commands
Running tests :
```bash
$ ./vendor/bin/phpunit --cache-result --order-by=defects --stop-on-defect --debug
```

Starting a local php web server
```bash 
$ php -S localhost:8000 -t public/
```
