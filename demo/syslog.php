<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 03.08.17
 * Time: 11:35
 */

for ($i=0; $i<1000000; $i++) {
    syslog(LOG_NOTICE, "Some message $i");
    usleep(300000);
    if ($i % 1000 == 0)
        echo "\n$i";
}