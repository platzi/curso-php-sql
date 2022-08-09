<?php

$server = "localhost";
$database = "finanzas_personales";
$username = "retaxmaster";
$password = "123";

$connection = new PDO("mysql:host=$server;dbname=$database", $username, $password);

$setnames = $connection->prepare("SET NAMES 'utf8'");
$setnames->execute();

var_dump($setnames);