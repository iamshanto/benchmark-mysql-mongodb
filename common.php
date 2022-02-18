<?php

use Faker\Generator;
use Symfony\Component\Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');
/**
 * @param $faker Generator
 * @return array
 */
function getUserData($faker)
{
    return [
        'username' => $faker->userName(),
        'name' => $faker->name(),
        'email' => $faker->email(),
        'password' => hashPassword($faker->password())
    ];
}

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => 6]);
}