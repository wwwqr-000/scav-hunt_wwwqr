<?php
$dsn = 'mysql:dbname=kartel;host=localhost';
$user = 'root';
$password = 'bremankartel';
 
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection Error: ' . $e->getMessage();
}
 
$file = new SplFileObject("data.txt");
while (!$file->eof()) {
    $line = $file->fgets();
    list($name,$lname,$birth)=explode(";",$line);
    
    $sth = $dbh->prepare('INSERT INTO `customers` (`id`, `name`, `lastname`, `birth`) VALUES (NULL, ?, ?, ?);');
    $sth->bindValue(1, $name, PDO::PARAM_STR);
    $sth->bindValue(2, $lname, PDO::PARAM_STR);
    $sth->bindValue(3, $birth, PDO::PARAM_STR);
    $sth->execute();
}
?>