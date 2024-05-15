<?php 
    $host = 'localhost';
    $db = 'forumDB';
    $user = 'root';
    $pw = '';
    $chrs = 'utf8mb4';
    $attr = "mysql:host=$host;dbname=$db;charset=$chrs";
    $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
?>