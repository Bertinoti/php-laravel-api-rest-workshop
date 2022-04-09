# Laravel API REST - Configuration files

This folder contains configurations files that must be used while running the application.

* [Nginx Configuration File](app.conf) that must properly bind mounted in our Nginx container.
* [Xdebug Configuration File](xdebug.ini) that must be properly placed in /usr/local/etc/php/conf.d folder whithin the php-fpm container.
* [Launch.json File](launch.json) for configuring debug mode in Visual Studio Code.
* [.env file](.env) for configuring the Laravel application.