<?php

function clearScreen() {
    echo "\033[2J\033[H";
}

function wave_animation($duration = 0.5, $width = 40, $height = 10, $fps = 30, $thickness = 2) {
    $start = microtime(true);
    $interval = 1 / $fps;

    do {
        clearScreen();
        $t = microtime(true) - $start;

        for ($y = 0; $y < $height; $y++) {
            $line = '';
            for ($x = 0; $x < $width; $x++) {
                $wave = sin(($x / $width) * 2 * pi() + $t * 10);
                $wave_y = intval(($wave + 1) * ($height / 2));

                // Check if current y is within thickness range of wave_y
                if (abs($y - $wave_y) <= $thickness) {
                    $line .= '~';
                } else {
                    $line .= ' ';
                }
            }
            echo $line . PHP_EOL;
        }

        usleep($interval * 1000000);
    } while ((microtime(true) - $start) < $duration);
}

wave_animation(2, 60, 15, 60, 5);
