<?php 

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\User;

class UserService
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'login' => $data['login'] ?? '',
                'senha' => $data['senha'] ?? '',
            ]);

            $fields['senha'] = password_hash($fields['senha'], PASSWORD_DEFAULT);

            $user = User::save($fields);

            if (!$user) return ['error' => 'Não foi possível criar usuário.'];

            return "User created successfully!";

        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Usuário existente.'];
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

            $user = User::find($userFromJWT['id_usuario']);

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

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];

            $fields = Validator::validate([
                'senha' => $data['senha'] ?? ''
            ]);

            $fields['senha'] = password_hash($fields['senha'], PASSWORD_DEFAULT);
            
            $user = User::update($userFromJWT['id_usuario'], $fields);

            if (!$user) return ['error'=> 'Não foi possível atualizar Usuário.'];

            return "Usuário atualizado!";
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->getMessage()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete(mixed $authorization, int|string $id)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];

            $user = User::delete($id);

            if (!$user) return ['error'=> 'Erro ao deletar usuário.'];

            return "Usuário deletado!";
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->getMessage()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}