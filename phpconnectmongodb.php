<?php
//terminal:composer require mongodb/mongodb 
// error use :composer update --ignore-platform-reqs
require_once __DIR__ . "/vendor/autoload.php";
// connect to MongoDB
function Getmongodb($namedb, $namecollection)
{
    $client = new MongoDB\Client("mongodb+srv://phantoan045:123123asD@dbwebflower.cxvlwuj.mongodb.net/?retryWrites=true&w=majority");
    // select a database
    $database = $client->selectDatabase($namedb);
    // select a collection
    $collection = $database->selectCollection($namecollection);
    return $collection;
}
?>
