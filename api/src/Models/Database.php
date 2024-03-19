<?php 

namespace App\Models;

use PDO;
use PDOException;

class Database 
{
    public static function getConnection()
    {
        try{
            $host = ('localhost');
            $user = ('root');
            $pass = ('admin');
            $bancodb = ('kabum');
        
            $conecta = new PDO("mysql:host=$host;dbname=$bancodb", $user, $pass);

            return $conecta;
        } catch(PDOException $e){
            echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
            die;
        }
    }
}