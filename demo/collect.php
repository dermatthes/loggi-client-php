<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.08.17
 * Time: 16:12
 */

require __DIR__ . "/../vendor/autoload.php";


for($i=0; $i<100000; $i++);

print_r (getrusage());

$driver = new \Rudl\Client\RudlClient("127.0.0.1");
$driver->registerResourceLogging();