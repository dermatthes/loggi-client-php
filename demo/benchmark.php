<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.08.17
 * Time: 18:14
 */


require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../vendor/autoload.php";



$driver = new \Rudl\Client\RudlClient("127.0.0.1");


for($i=0; $i<10000000; $i++) {
    $driver->sendMessage("id" . ($i % 100000));
}