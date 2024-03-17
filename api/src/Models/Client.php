<?php 

namespace App\Models;

use App\Models\Database;
use PDO;

class Client extends Database
{
    public static function save(array $data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            INSERT 
            INTO 
                tb_cliente (nome, data_nascimento, cpf, rg, telefone)
            VALUES
                (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['nome'], 
            $data['data_nascimento'], 
            $data['cpf'], 
            $data['rg'], 
            $data['telefone']
        ]);

        return $pdo->lastInsertId() > 0 ? true : false;
    }

    public static function find()
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            SELECT 
                *
            FROM 
                tb_cliente
        ');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findOne(int|string $id_cliente)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            SELECT 
                *
            FROM 
                tb_cliente
            WHERE 
                id_cliente = ?
        ');

        $stmt->execute([$id_cliente]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update(int|string $id, array $data)
    { 
        $pdo = self::getConnection();
        
        $stmt = $pdo->prepare('
            UPDATE
                tb_cliente
            SET 
                nome = ?, 
                data_nascimento = ?, 
                rg = ?, 
                telefone = ? 
            WHERE 
                id_cliente = ?
        ');

        $stmt->execute([$data['nome'], $data['data_nascimento'],
                        $data['rg'], 
                        $data['telefone'], $id]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function delete(int|string $id)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            DELETE 
            FROM 
                tb_cliente
            WHERE 
                id_cliente = ?
        ');

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0 ? true : false;
    }
}