<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.08.17
 * Time: 18:14
 */


require __DIR__ . "/../vendor/autoload.php";



$driver = new \Rudl\Client\RudlClient("127.0.0.1");



$driver->sendMessage(str_pad("", 9000, "#"));
