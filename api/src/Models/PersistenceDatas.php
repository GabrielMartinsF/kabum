<?php 

namespace App\Models;

use PDO;

class PersistenceDatas extends Database
{
    public static function insert($table, $data = array()){

        $connection = self::getConnection();

        $fieldtNameNormalized =  implode(', ', array_keys($data));
        
        $fieldValueNormalized = "'". implode("', '", array_values($data)) ."'";

        $query = "INSERT INTO ".$table." (".$fieldtNameNormalized.") VALUES (".$fieldValueNormalized.")";

        $sth = $connection->prepare($query);

        $sth->execute();
        
        $lastID = $connection->lastInsertId();
    
        return !empty($lastID) ? $lastID : "";
    }

    public static function getAll($table){

        $connection = self::getConnection();

        $query = "SELECT * FROM ".$table."";

        $sth = $connection->prepare($query);

        $sth->execute();
        
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        return !empty($result) ? $result : array();
    }

    public static function getById($table, $id, $param){

        $connection = self::getConnection();

        $query = "SELECT * FROM ".$table." WHERE ".$param." = :id";

        $sth = $connection->prepare($query);

        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        
        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function getByLogin($table, $login){

        $connection = self::getConnection();

        $query = "SELECT * FROM ".$table." WHERE login = :login";

        $sth = $connection->prepare($query);

        $sth->bindValue(":login", $login["login"], PDO::PARAM_STR);

        $sth->execute();
        
        if ($sth->rowCount() < 1) return false;

        $user = $sth->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($login['senha'], $user['senha'])) return false;

        return [
            'id'   => $user['id_usuario'],
            'name' => $user['login'],
        ];;
    }

    public static function getAllUsers($table) {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            SELECT 		
                client.id_cliente, client.nome, client.data_nascimento, 
                client.cpf, client.rg, client.telefone, address.id_endereco, address.logradouro, address.logradouro_numero, 
                address.logradouro_complemento, address.logradouro_bairro, address.logradouro_cep, 
                address.logradouro_cidade, address.logradouro_estado, address.id_cliente
            FROM tb_cliente as client
                INNER JOIN tb_endereco address ON client.id_cliente = address.id_cliente
            WHERE address.id_cliente = client.id_cliente
            ORDER BY client.id_cliente
        ');

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $id = null;
        $data = [];

        foreach ($stmt as $row) {

            $endereco = [
                'id_endereco'=>$row['id_endereco'],
                'logradouro' => $row['logradouro'], 
                'logradouro_numero' => $row['logradouro_numero'],
                'logradouro_complemento' => $row['logradouro_complemento'], 
                'logradouro_bairro' => $row['logradouro_bairro'], 
                'logradouro_cep' => $row['logradouro_cep'], 
                'logradouro_cidade' => $row['logradouro_cidade'], 
                'logradouro_estado' => $row['logradouro_estado']
            ];

            

            if ($id == $row['id_cliente']) {
                $data[array_key_last($data)]['enderecos'][] = $endereco;
            } else {
                $id = $row['id_cliente'];
                $data[] = [
                    'id_cliente' => $row['id_cliente'],
                    'nome' => $row['nome'],
                    'data_nascimento' => $row['data_nascimento'],
                    'cpf' => $row['cpf'],
                    'rg' => $row['rg'],
                    'telefone' => $row['telefone'],
                ];
                $data[array_key_last($data)]['enderecos'][] = $endereco;
            }
        }
        return $data;
    }

    public static function getClientById($table, $id) {
       
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            SELECT 		
                client.id_cliente, client.nome, client.data_nascimento, 
                client.cpf, client.rg, client.telefone, address.id_endereco, address.logradouro, address.logradouro_numero, 
                address.logradouro_complemento, address.logradouro_bairro, address.logradouro_cep, 
                address.logradouro_cidade, address.logradouro_estado, address.id_cliente
            FROM tb_cliente as client
                INNER JOIN tb_endereco address ON client.id_cliente = address.id_cliente
            WHERE client.id_cliente = :id
        ');
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $id = null;
        $data = [];

        foreach ($stmt as $row) {

            $endereco = [
                'id_endereco'=>$row['id_endereco'],
                'logradouro' => $row['logradouro'], 
                'logradouro_numero' => $row['logradouro_numero'],
                'logradouro_complemento' => $row['logradouro_complemento'], 
                'logradouro_bairro' => $row['logradouro_bairro'], 
                'logradouro_cep' => $row['logradouro_cep'], 
                'logradouro_cidade' => $row['logradouro_cidade'], 
                'logradouro_estado' => $row['logradouro_estado']
            ];

            

            if ($id == $row['id_cliente']) {
                $data[array_key_last($data)]['enderecos'][] = $endereco;
            } else {
                $id = $row['id_cliente'];
                $data[] = [
                    'id_cliente' => $row['id_cliente'],
                    'nome' => $row['nome'],
                    'data_nascimento' => $row['data_nascimento'],
                    'cpf' => $row['cpf'],
                    'rg' => $row['rg'],
                    'telefone' => $row['telefone'],
                ];
                $data[array_key_last($data)]['enderecos'][] = $endereco;
            }
        }
        return $data;
    }

    public static function update($table, $where, $id, $data) {

        $connection = self::getConnection();

        $values = [];

        foreach ($data as $key => $value) {
            $values[] = $key ." = '".$value."'";
        }

        $params = implode(", ", $values);

        $query = "UPDATE ".$table." SET ".$params." WHERE ".$where." = ".$id."";
        
        $sth = $connection->prepare($query);

        $sth->execute();

        return $sth->rowCount() > 0 ? true : false;
    }

    public static function delete($table, $where, $id){

        $connection = self::getConnection();

        $query = "DELETE FROM ".$table." WHERE ".$where." = ".$id."";

        $sth = $connection->prepare($query);
        
        $sth->execute();
        
        return $sth->rowCount() > 0 ? true : false;
    }

}