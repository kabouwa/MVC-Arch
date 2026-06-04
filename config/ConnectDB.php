<?php
//Load Environement variable from .env
foreach(file(__DIR__."/.env", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES) as $line){
    $env_var = trim($line);
    if(str_starts_with($env_var,'#'))continue;
    putenv($env_var);
}
//Get env variable into array
define('DB',[
    "host" => (string) getenv("DB_HOST"),
    "port" => (int)    getenv("DB_PORT"),
    "user" => (string) getenv("DB_USER"),
    "pass" => (string) getenv("DB_PASS"),
    "name" => (string) getenv("DB_NAME")
]);
function DSN($host,$port,$dbname){return "mysql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname . ";charset=utf8";}
//Establish connection to db
try{
    $dsn = DSN(DB['host'],DB['port'],DB['name']);
    $conn = new PDO(
        $dsn,
        DB['user'],
        DB['pass']
    );
}catch(Exception $e){
    die("<h1>CANNOT ESTABLISH CONNECTION TO DATABASE !</h1>");
}
?>