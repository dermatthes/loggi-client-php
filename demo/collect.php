<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.08.17
 * Time: 16:12
 */

require __DIR__ . "/../vendor/autoload.php";


for($i=0; $i<10; $i++);

print_r (getrusage());

$driver = new \Rudl\Client\RudlClient("192.168.90.114");
$driver->registerResourceLogging();