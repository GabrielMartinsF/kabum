<?php 

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\User;
use App\Entity\UserEntity;

class UserService
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'login' => $data['login'] ?? '',
                'senha' => $data['senha'] ?? ''
            ]);

            $fields['senha'] = password_hash($fields['senha'], PASSWORD_DEFAULT);

            $rqst = new UserEntity();
            $rqst->setLogin($fields['login']);
            $rqst->setSenha($fields['senha']);

            $user = User::save($fields);

            if (!$user) return ['error' => 'Erro ao criar usuário.'];

            return "usuário criado!";

        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'usuário já existe'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function auth(array $data)
    {
        try {
            $fields = Validator::validate([
                'login' => $data['login'] ?? '',
                'senha' => $data['senha'] ?? '',
            ]);

            $user = User::authentication($fields);

            if (!$user) return ['error'=> 'Erro de autenticação'];

            return JWT::generate($user);
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetch(mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];
            
            $user = User::find($userFromJWT['id']);

            if (!$user) return ['error'=> 'Erro na busca de usuários.'];

            return $user;
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function update(mixed $authorization, array $data)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            var_dump($authorization);

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];

            $fields = Validator::validate([
                'login' => $data['login'] ?? '',
                'senha' => $data['senha'] ?? ''
            ]);

            $fields['senha'] = password_hash($fields['senha'], PASSWORD_DEFAULT);

            $user = User::update($userFromJWT['id'], $fields);

            if (!$user) return ['error'=> 'Erro ao atualizar usuário.'];

            return "usuário atualizado!";
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->getMessage()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete(mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];
            
            $user = User::delete($userFromJWT['id']);

            if (!$user) return ['error'=> 'Erro ao deletar usuário.'];

            return "Usuário deletado";
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}