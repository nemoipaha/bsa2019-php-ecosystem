<?php

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

// dynamic types
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

declare(strict_types=1);

function tuple(int $a, int $b): array
{
    return [$x, $y];
}
