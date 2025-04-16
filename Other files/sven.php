#!/usr/bin/env php
<?php

$commands = [
    'hello' => 'hello.php',
];

$argv = $_SERVER['argv'];
$command = $argv[1] ?? 'help'; 
$args = array_slice($argv, 2);
var_dump($args);

if (isset($commands[$command])){
    require $commands[$command];
    run($args);
}