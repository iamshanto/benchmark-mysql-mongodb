<?php
require_once 'common.php';

$faker = Faker\Factory::create();
$collection = (new MongoDB\Client)->test->users;

$start = microtime(true);

foreach (range(0, 1) as $i) {
    $data = getUserData($faker);
    $collection->insertOne($data);
}

$time_elapsed_second = round((microtime(true) - $start), 2);
echo sprintf("Execution time: %s", $time_elapsed_second);