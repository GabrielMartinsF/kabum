<?php 

namespace App\Models;

use PDO;
use PDOException;

class Database 
{
    public static function getConnection()
    {
        try{
            $host = 'localhost';
            $user = 'root';
            $pass = 'admin';
            $base = 'kabum';    
        
            $pdo = new PDO("mysql:host={$host};dbname={$base};charset=UTF8;", $user, $pass);

            return $pdo;
        } catch(PDOException $e){
            echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
            die;
        }
    }
}