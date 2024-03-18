<?php 

namespace App\Models;

use PDO;
use App\Models\PersistenceDatas;

class User 
{
    public static function save($usuario)
    {
        $user = PersistenceDatas::insert("tb_usuario", array(
            "login" => $usuario["login"],
            "senha" => $usuario["senha"]
        ));

        return $user;
    }

    public static function authentication($usuario)
    {
        $user = PersistenceDatas::getByLogin("tb_usuario", $usuario);

        return $user;
    }

    public static function find($id_usuario)
    {
        $users = PersistenceDatas::getById("tb_usuario", $id_usuario, "id_usuario");

        return $users;
    }

    public static function update($id_usuario, $data)
    { 
        $stmt = PersistenceDatas::update("tb_usuario","id_usuario", $id_usuario[0], array(
            "login" => $data["login"],
            "senha" => $data["senha"]
        ));

        return $stmt;
    }

    public static function delete(int|string $id)
    {        
        $stmt = PersistenceDatas::delete("tb_usuario", "id_usuario", $id);

        return $stmt;
    }
}