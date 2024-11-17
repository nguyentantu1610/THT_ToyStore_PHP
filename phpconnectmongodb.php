<?php
//terminal:composer require mongodb/mongodb 
// error use :composer update --ignore-platform-reqs
require_once __DIR__ . "/vendor/autoload.php";
// connect to MongoDB
function Getmongodb($namedb, $namecollection)
{
    $client = new MongoDB\Client("connection_string");
    // select a database
    $database = $client->selectDatabase($namedb);
    // select a collection
    $collection = $database->selectCollection($namecollection);
    return $collection;
}
?>
