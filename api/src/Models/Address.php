<?php 

namespace App\Models;

use App\Models\Database;
use PDO;

class Address extends Database
{
    public static function save(array $data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            INSERT 
            INTO 
                tb_endereco (logradouro, logradouro_numero, logradouro_complemento, 
                logradouro_bairro, logradouro_cep, logradouro_cidade, logradouro_estado, id_usuario)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['logradouro'], 
            $data['logradouro_numero'], 
            $data['logradouro_complemento'], 
            $data['logradouro_bairro'], 
            $data['logradouro_cep'],
            $data['logradouro_cidade'], 
            $data['logradouro_estado'], 
            $data['id_usuario']
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
                tb_endereco
        ');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findOne(int|string $id_endereco)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            SELECT 
                *
            FROM 
                tb_endereco
            WHERE 
                id_endereco = ?
        ');

        $stmt->execute([$id_endereco]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update(int|string $id, array $data)
    { 
        $pdo = self::getConnection();
        
        $stmt = $pdo->prepare('
            UPDATE
                tb_endereco
            SET 
                logradouro = ?, 
                logradouro_numero = ?, 
                logradouro_complemento = ?, 
                logradouro_bairro = ?, 
                logradouro_cep = ?, 
                logradouro_cidade = ?, 
                logradouro_estado = ?
            WHERE 
                id_endereco = ?
        ');

        $stmt->execute([$data['logradouro'], $data['logradouro_numero'],
                        $data['logradouro_complemento'], $data['logradouro_bairro'], 
                        $data['logradouro_cep'], $data['logradouro_cidade'], 
                        $data['logradouro_estado'], $id]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function delete(int|string $id)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            DELETE 
            FROM 
                tb_endereco
            WHERE 
                id_endereco = ?
        ');

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0 ? true : false;
    }
}