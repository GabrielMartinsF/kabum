<?php 

namespace App\Models;

use PDO;
use App\Models\PersistenceDatas;

class Address 
{
    public static function save($endereco)
    {
        $address = PersistenceDatas::insert("tb_endereco", array(
            "logradouro" => $endereco["logradouro"],
            "logradouro_numero" => $endereco["logradouro_numero"],
            "logradouro_complemento" => $endereco["logradouro_complemento"],
            "logradouro_bairro" => $endereco["logradouro_bairro"],
            "logradouro_cep" => $endereco["logradouro_cep"],
            "logradouro_cidade" => $endereco["logradouro_cidade"],
            "logradouro_estado" => $endereco["logradouro_estado"],
            "id_cliente" => $endereco["id_cliente"]
        ));

        return $address;
    }

    public static function find()
    {
        $users = PersistenceDatas::getAll("tb_endereco");

        return $users;
    }

    public static function findOne(int|string $id_endereco)
    {
        $user = PersistenceDatas::getById("tb_endereco", $id_endereco, "id_endereco");

        return $user;
    }

    public static function update($id_endereco, $data)
    { 
        $stmt = PersistenceDatas::update("tb_endereco","id_endereco", $id_endereco[0], array(
            "logradouro" => $data["logradouro"],
            "logradouro_numero" => $data["logradouro_numero"],
            "logradouro_complemento" => $data["logradouro_complemento"],
            "logradouro_bairro" => $data["logradouro_bairro"],
            "logradouro_cep" => $data["logradouro_cep"],
            "logradouro_cidade" => $data["logradouro_cidade"],
            "logradouro_estado" => $data["logradouro_estado"],
        ));

        return $stmt;
    }

    public static function delete(int|string $id)
    {        
        $stmt = PersistenceDatas::delete("tb_endereco", "id_endereco", $id);

        return $stmt;
    }
}