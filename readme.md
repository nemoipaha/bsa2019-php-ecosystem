![php7](https://www.fastwebhost.in/blog/wp-content/uploads/2016/08/PHP7-ELEPHANT.png)

## Introduction

### History
PHP: Hypertext Preprocessor (or simply PHP) is a general-purpose programming language originally designed for web development.

Firstly PHP was just **p**ersonal **h**ome **p**age created by [Rasmus Lerdorf](https://ru.wikipedia.org/wiki/%D0%9B%D0%B5%D1%80%D0%B4%D0%BE%D1%80%D1%84,_%D0%A0%D0%B0%D1%81%D0%BC%D1%83%D1%81) in 1995.

*PHP (ПХП, похапэ, пэхэпэ, пиашпи, пых-пых, ПиЭйчПи) — один из немногих языков программирования, владея которым, можно заработать себе на хлеб $ало и воду.*

### High-level language
```php
// C/C++ language allocate memory
int *testArray = malloc(5 * sizeof(int));
free(testArray);

// allocate memory
$testArray = [];

$testArray[] = 'Hi!';

// cleanup memory by garbage collector
```
Memory is managed dynamically. Written in Zend engine using C language.

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
Multi thread with POSIX and `--pthreads` extension.

High-load tasks with message queue systems(RabbitMQ, etc.).

### Too many dollars $$$
```php
$kernel = new Kernel($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
```
[Why do we use $ in php?](https://www.quora.com/Why-do-we-use-a-dollar-symbol-before-variables-in-PHP)

## PHP 7.0+ syntax

Features:
* [PHP 5.6 vs 7.0](http://www.phpbenchmarks.com/en/comparator/php)
* memory optimized
* new exception hierarchy
* syntax sugar `??, <=>`
* nullables `?string`
* scalar types 
* `void` return type
* iterable type
* anonymous classes

![php7 rules](https://www.pvsm.ru/images/2016/12/20/uluchshenie-proizvoditelnosti-PHP-7.jpg)

### Deprecated tags
```php
<script language="php">
 // cannot be used anymore
</script>

// no  ASP tags
<% echo 'Oh, God!'; %>

<?php echo 'Hello, sweety!'; ?>
<?= "Whaat?" ?>
```
### Deprecated mysql_* functions
```php
$query = 'SELECT * FROM USERS WHERE 1 = 1';
$result = mysql_db_query($somedb, $query, $connection);

// use PDO
$pdo = new PDO('mysql:host=localhost,dbname=test');
$query = $pdo->prepare('SELECT * FROM USERS WHERE age = :age');
$result = $query->execute([':age' => 24]);
```

### Deprecated class name constructor
```php
class A 
{
    // bad, PHP 4 syntax
    public function A() 
    {
        
    }
    
    // good
    public function __construct() 
    {
         
    }
}
```

### Deprecated functions
```php
ereg();
eregi();
ereg_replace();
...
```
Use preg_* functions like `preg_match();`.

### Array destructuring
```php
$user = ['John', 'Doe', 29];

// list syntax
list($firstname, $lastname, $age) = $user;

// short array syntax
[$firstname, $lastname, $age] = $user;

// destructuring with keys
[
    'first_name' => $firstname,
    'last_name' => $lastname,
    'age' => $age
] = $user;
```

### New variable call combinations
```php
$foo = function() {
    return [
        'bar' => function() { echo 'bar'; },
        'foo' => function() { echo 'foo'; }
    ];
};
// call a closure inside an array returned by another closure
$foo()['bar']();
```

### String character access
```php
function getUserName() {
    return 'Pavel';
}
// access a character by index
echo getUserName(){0};
```

### Object public property access from array
```php
$ball = new stdClass();
$ball->type = 'football';

$ball1 = new stdClass();
$ball1->type = 'basketball';

echo [$ball, $ball1][0]->type;
```

### Nested double colons ::
```php
class Student
{
    public static $courses = [
        'math',
        'programming',
        'databases'
    ];

    public static function getSchedule(): Schedule
    {
        return new Schedule();
    }

    public function getCredits(): Credits
    {
        return new Credits();
    }
}

class Schedule
{
    public static $classes = 5;
}

class Credits
{
    public static function getCreditsPerYear(): int
    {
        return 350;
    }
}

$students = [
    'Bob' => new Student(),
    'Rachel' => new Student()
];

// access a static property on a string class name or object inside an array
$students['Bob']::$courses;

// access a static property on a string class name or object returned by a static method call on a string class name or object
$students['Rachel']::getSchedule()::$classes;

// call a static method on a string class name or object returned by an instance method call
$students['Rachel']->getCredits()::getCreditsPerYear();
```

### Nested functions call
```php
function foo(): callable {
    return function(): string {
        return 'Hi!';
    };
}

// call a callable returned by function
echo foo()();

$foo = function(string $param): callable {
    return function() use($param): string {
        return $param;
    };
};

// call a callable returned by another callable
echo $foo('Hi!')();

// also works with classes
class A
{
    public function foo(): callable
    {
        return function(): string {
            return 'Hi!';
        };
    }

    public static function bar(): callable
    {
        return function(): string {
            return 'Hi!';
        };
    }
}

(new A)->foo()();
A::bar()();
```

#### General expressions dereferencing schema
```php
// array key
(expression)['key']

// class property
(expression)->prop

// call a method
(expression)->method()

// static prop
(expression)::$foo

// static method
(expression)::method()

// call a callable
(expression)()

// access a string character
(expression){0}
```

### Null coalesce operator ??
```php
$key = $request->get('access_token') ?? null;
$key = isset($_GET['access_token']) ? $_GET['access_token'] : null;
```

### Spaceship operator
```php
$a = 5;
$b = 10;

// $a == $b : 0 
// $a > $b : 1
// $a < $b : -1
$res = $a <=> $b;

$list = [-1, 10, -6, 126];
usort($list, function(int $a, int $b) {
    return $a <=> $b;
});
```

### Const arrays
```php
define('COLORS', [
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff'
]);

echo COLORS['red'];

class Drawer
{
    // visibility added in php 7.1
    public const COLORS = [
        'red' => '#ff0000',
        'green' => '#00ff00',
        'blue' => '#0000ff'
    ];
}

echo Drawer::COLORS['red'];
```

### Integer division aka intdiv()
```php
$a = intdiv(8, 3);
$b = 8 % 3;

try {
    $c = intdiv(1, 0);
} catch (DivisionByZeroError $e) {
    // logic
}
```

### Exceptions

#### New hierarchy
* Throwable
    * `Exception implements Throwable`
        * LogicException
            * BadFunctionCallException
                * BadMethodCallException
            * DomainException
            * InvalidArgumentException
            * LengthException
            * OutOfRangeException
        * RuntimeException
            * OutOfBoundsException
            * OverflowException
            * RangeException
            * UnderflowException
            * UnexpectedValueException
    * `Error implements Throwable`
        * AssertionError
        * ArithmeticError
        * DivisionByZeroError
        * ParseError
        * TypeError

#### Multiple catch
```php
try {
    // code
} catch (Throwable $e) {
    // catch all possible errors
}

try {
    // code
} catch (InvalidArgumentException | MyException $e) {
    // catch only specific
}
```

### Binding Closure
```php
class Greeting {
    private $hello = 'Hello';
}

$closure = function(string $name) {
    return "{$this->hello}, {$name}";
};

echo $closure->call(new Greeting(), 'Bob');
```

### Group use statements
```php
use Some\Namespace{ClassA, ClassB};
use function Some\Namespace{funcA, funcB};
use const Some\Namespace{CONST_A, CONST_B};
```

### Anonymous classes
```php
interface Logger {}

class BaseLogger {}

trait WriteToFile {}

class Util
{
    private $logger;

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}

$util = new Util();
$util->setLogger(
    new class ($config) extends BaseLogger implements LoggerInterface {
        use WriteToFile;

        private $config;

        public function __construct(array $config)
        {
            $this->config = $config;
        }

        public function log($msg)
        {
            $this->write('app.log', $msg);
        }
    }
);
```
Object of anonymous class lives once at runtime. Can be used in test code to mock objects. Think before use :)

### Type hinting
* bool
* float
* int
* string
* array
* iterable

```php
function typed(string $a, bool $b, float $c): array {}
```

#### Strict types
```php
declare(strict_types=1);

function intSum(int $a, int $b): int
{
    return $a + $b;
}

// good
intSum(1, 2);

// TypeError thrown
intSum(0.1, 2);
```
Use types everywhere! )

### Nullables
```php
class Profile
{
    private $name;
    private $age;

    public function __construct(string $name, ?int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }
}
```

### Void type
```php
// php 7.1
function doSomething(): void 
{
    // write to log file
    return;
}
```

### Iterable type
```php
function render(iterable $list)
{
    foreach ($list as $item) {}
}

function numbers(): iterable
{
    return [1, 2];
}

function numbersAsIterator(): iterable
{
    $numbers = new ArrayObject([1, 2]);

    return $numbers->getIterator();
}
```

## Ecosystem

### What can I build?

* CLI
* Server-side apps(backend)
* CRM, CMS, forum, e-commerce
* API(REST, GraphQL)

### PHP-FIG & PSR

[https://www.php-fig.org/](https://www.php-fig.org/)

### Composer & Pecl
![composer](https://getcomposer.org/img/logo-composer-transparent2.png)

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


```php
// before
require __DIR__ . '/Academy.php';
require __DIR__ . '/PHP.php';

Academy::start();
PHP::rock();

// after(entry point file aka index.php)
require __DIR__ . '/vendor/autoload.php';

Academy::start();
PHP::rock();
```

### Frameworks
* MVC
    * Symfony
    * Laravel
    * Zend
    * Phalcon
    * Yii
* API
    * Slim
    * Lumen
    * Symfony 4
* CMS
    * Wordpress
    * Joomla
    * Drupal
* CRM
    * SugarCRM
    * SuiteCRM
    * vTiger
* E-commerce
    * Magento
    * Opencart
    * WooCommerce
* Bot
    * Botman(chat bot, messenger)

![php development](https://www.teaminindia.com/Content/images/php_development_services_banner_img.png)

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

### Who uses PHP in production
1. wikipedia
2. vk.com
3. facebook.com
4. wordpress.org
5. 9gag.com
6. freepik.com

![dark side php](https://cs8.pikabu.ru/post_img/2017/03/06/11/1488825124234724523.jpg)

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

![i am neo](http://memesmix.net/media/created/6d6gtz.jpg)
