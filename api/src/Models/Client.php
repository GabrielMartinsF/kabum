<?php 

namespace App\Models;

use PDO;
use App\Models\PersistenceDatas;

class Client extends Address
{
    public static function save($client)
    {
        $id = PersistenceDatas::insert("tb_cliente", array(
            "nome" => $client['nome'],
            "data_nascimento" => $client["data_nascimento"],
            "cpf" => $client["cpf"],
            "rg" => $client["rg"],
            "telefone" => $client["telefone"]      
        ));

        if($client["endereco"] !== "") {
            $endereco = $client["endereco"];

            PersistenceDatas::insert("tb_endereco", array(
                "logradouro" => $endereco["logradouro"],
                "logradouro_numero" => $endereco["logradouro_numero"],
                "logradouro_complemento" => $endereco["logradouro_complemento"],
                "logradouro_bairro" => $endereco["logradouro_bairro"],
                "logradouro_cep" => $endereco["logradouro_cep"],
                "logradouro_cidade" => $endereco["logradouro_cidade"],
                "logradouro_estado" => $endereco["logradouro_estado"],
                "id_cliente" => $id 
            ));
        }

        return $id;
    }

    public static function find()
    {
        $users = PersistenceDatas::getAllUsers("tb_cliente");

        return $users;
    }

    public static function findOne(int|string $id_cliente)
    {
        $user = PersistenceDatas::getClientById("tb_cliente", $id_cliente);

        return $user;
    }

    public static function update($id_cliente, $data)
    { 
        $stmt = PersistenceDatas::update("tb_cliente","id_cliente", $id_cliente, array(
            "nome" => $data['nome'],
            "data_nascimento" => $data["data_nascimento"],
            "rg" => $data["rg"],
            "telefone" => $data["telefone"]      
        ));

        return $stmt;
    }

    public static function delete(int|string $id)
    {
        $stmt = PersistenceDatas::delete("tb_cliente", "id_cliente", $id);

        return $stmt;
    }
}