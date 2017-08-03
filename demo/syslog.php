<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 03.08.17
 * Time: 11:35
 */

for ($i=0; $i<100000000; $i++) {
    syslog(2, "Some message $i");
    if ($i % 1000 == 0)
        echo "\n$i";
}