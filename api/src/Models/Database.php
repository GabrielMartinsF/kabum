<?php 

namespace App\Models;

use PDO;

class Database 
{
    public static function getConnection()
    {
        $host = 'localhost';
        $user = 'root';
        $pass = 'admin';
        $base = 'kabum';

        $pdo = new PDO("mysql:host={$host};dbname={$base};charset=UTF8;", $user, $pass);

        return $pdo;
    }
}