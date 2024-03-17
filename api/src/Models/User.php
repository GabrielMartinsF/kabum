<?php 

namespace App\Models;

use App\Models\Database;
use PDO;

class User extends Database
{
    public static function save(array $data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            INSERT 
            INTO 
                tb_usuario (login, senha)
            VALUES
                (?, ?)
        ");

        $stmt->execute([
            $data['login'], 
            $data['senha']
        ]);

        return $pdo->lastInsertId() > 0 ? true : false;
    }

    public static function authentication(array $data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            SELECT 
                *
            FROM 
                tb_usuario
            WHERE 
                login = ?
        ");

        $stmt->execute([$data['login']]);

        if ($stmt->rowCount() < 1) return false;

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($data['senha'], $user['senha'])) return false;

        return [
            'id_usuario'   => $user['id_usuario'],
            'login'=> $user['login'],
        ];
    }

    public static function find(int|string $id_usuario)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            SELECT 
                *
            FROM 
                tb_usuario
            WHERE 
                id_usuario = ?
        ');

        $stmt->execute([$id_usuario]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update(int|string $id, array $data)
    {
        $pdo = self::getConnection();
        
        $stmt = $pdo->prepare('
            UPDATE 
                tb_usuario
            SET 
                senha = ?
            WHERE 
                id_usuario = ?
        ');

        $stmt->execute([$data['senha'], $id]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function delete(int|string $id)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            DELETE 
            FROM 
                tb_usuario
            WHERE 
                id_usuario = ?
        ');

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0 ? true : false;
    }
}