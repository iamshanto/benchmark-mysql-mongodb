<?php
require_once 'common.php';

$pdo = new PDO(sprintf("mysql:dbname=%s;host=%s", $_ENV['MYSQL_DB_NAME'], $_ENV['MYSQL_DB_HOST']), $_ENV['MYSQL_DB_USER'], $_ENV['MYSQL_DB_PASS']);
$faker = Faker\Factory::create();

$stm = $pdo->query("SELECT * FROM users");
$result = $stm->fetchAll();

$start = microtime(true);

$sql = 'INSERT INTO users(name, username, email, password) VALUES( :name, :username, :email, :password)';
$statement = $pdo->prepare($sql);
foreach (range(0, 1) as $i) {
    $data = getUserData($faker);
    $statement->execute([
        ':name' => $data['name'],
        ':username' => $data['username'],
        ':email' => $data['email'],
        ':password' => $data['password']
    ]);
}

$time_elapsed_second = round((microtime(true) - $start), 2);
echo sprintf("Execution time: %s", $time_elapsed_second);