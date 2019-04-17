# PHP ecosystem
![php7](https://www.fastwebhost.in/blog/wp-content/uploads/2016/08/PHP7-ELEPHANT.png)

## Basics

### History
PHP: Hypertext Preprocessor (or simply PHP) is a general-purpose programming language originally designed for web development.

Created by [Rasmus Lerdorf](https://ru.wikipedia.org/wiki/%D0%9B%D0%B5%D1%80%D0%B4%D0%BE%D1%80%D1%84,_%D0%A0%D0%B0%D1%81%D0%BC%D1%83%D1%81) in 1994.

### High-level language
```php
c lang code vs php code
```
Memory is managed dynamically. Written is Zend engine using C language.

[https://github.com/php](https://github.com/php)

### PHP is interpreted
```php
php hello.php
```

### OOP vs FP vs procedural
```php
// oop
namespace A;

interface Schedulable
{
    public function setTime(\DateTime $datetime): void;
}

abstract class Task implements Schedulable
{
    private $time;

    public function setTime(\DateTime $time): void
    {
        $this->time = $time;
    }
}

class MegaTask extends Task {}

// functional
$p = function() { return 'p'; };
$h = function() { return 'h'; };
echo $p() . $h() . $p();

// procedural
function header() {
    $title = 'Hello!';
    
    echo '<div>' . $title . '</div>';
}
function content() {
    echo '<div>content</div>';
}
```

### Weak typing system
```php
$one = '1';
$two = 2;

// int(3)
var_dump($one + $two);

$foo = null;
$bar = false;

// true
var_dump($foo == $bar);

// false
var_dump($foo === $bar);
```

But from PHP 7.0
```php
declare(strict_types=1);

function tuple(int $a, int $b): array
{
    return [$x, $y];
}
```

### Single threaded 
Multi thread with `--pthreads` extension.

High-load tasks with message queue systems(RabbitMQ, etc.)

### Too many dollars $$$
```php
```

## PHP 7.0+ syntax

## Ecosystem

### What can I build?

* CLI,
* Server-side apps(backend),
* CRM, CMS, forum, e-commerce
* API(REST, GraphQL)

### PHP-FIG & PSR

[https://www.php-fig.org/](https://www.php-fig.org/)

### Composer & Pecl

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

[https://getcomposer.org/download/](https://getcomposer.org/download/)
[https://github.com/laravel/laravel/blob/master/composer.json](https://github.com/laravel/laravel/blob/master/composer.json)

Commands:
* composer init
* composer require vendor/package-name
* composer install
* composer dump-autoload

#### composer.lock
[https://phpprofi.ru/blogs/post/15](https://phpprofi.ru/blogs/post/15)

**PECL** is a repository for PHP Extensions, providing a directory of all known extensions and hosting facilities for downloading and development of PHP extensions.

[https://pecl.php.net/](https://pecl.php.net)

### Composer autoload & PSR-4
```
"autoload": {
    "psr-4": {
        "App\\": "app/"
    },
    "classmap": [
        "directory1",
        "directory2"
    ],
    "files": [
        "MyClass.php"
    ]
},
"autoload-dev": {
    "psr-4": {
        "Tests\\": "tests/"
    }
}
```

Entry point file(index.php): `require __DIR__ . '/vendor/autoload.php';`

### Frameworks
* MVC
* API
* CMS,
* CRM
* E-commerce
* Bot

***(show diagram)***

[**packagist.org**](https://packagist.org/)

*When you search for a package take a look at github stars, resolved issues and last commit date.*

### PHP & webservers

* Local web server `php -S localhost:8888`
* nginx, php-fpm
* apache, mod-php

How it is working?

![php-fpm_nginx](https://datadog-prod.imgix.net/img/blog/nginx-502-bad-gateway-errors-php-fpm/php-fpm-health-3.png?fit=max)

*mywebsite.nginx.conf*
```
server {
    listen 80;

    root /var/www/app/public;

    index index.php index.htm index.html;
    
    # ...settings
    
    location ~ \.php$ {
        # php-fpm container url
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        include fastcgi_params;
    }
}
```

## Typical PHP development environment

* Use OS(Linux, Windows, MAC)
* Use Version control system(Git)
* Use linters: phpstan, phpmd, phpcs
* Use debuggers: xdebug, zend debugger
* Use profilers to optimize memory: blackfire.io, xhprof
* Standardize dev environment: [vagrant-homestead](https://laravel.com/docs/5.8/homestead), [docker-laradock](https://laradock.io/)
* Use smart IDE: [PHPStorm](https://www.jetbrains.com/phpstorm/), [VSCode](https://code.visualstudio.com/)

## Links
* [clean-code-php](https://github.com/jupeter/clean-code-php)
* [awesome-php](https://github.com/ziadoz/awesome-php)
* [Laracasts](https://laracasts.com/)
* [codecourse](https://www.youtube.com/channel/UCpOIUW62tnJTtpWFABxWZ8g)

