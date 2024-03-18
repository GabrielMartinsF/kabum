<?php 

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\Client;

class ClientService
{
    public static function create(array $data, mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];

            $fields = Validator::validate([
                'nome' => $data['nome'] ?? '',
                'data_nascimento' => $data['data_nascimento'] ?? '',
                'cpf' => $data['cpf'] ?? '',
                'rg' => $data['rg'] ?? '',
                'telefone' => $data['telefone'] ?? '',
            ]);

            $client = Client::save($fields);

            if (!$client) return ['error' => 'Erro ao criar cliente.'];

            return "Cliente criado!";

        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Sorry, client already exists.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetchAll(mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];
            
            $client = Client::find();

            return $client;
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetchClientAdrress(mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];
            
            $client = Client::findClientAddress();

            return $client;
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetchOne(array $id_cliente, mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];
            
            $client = Client::findOne($id_cliente[0]);

            if (!$client) return ['error'=> 'Cliente não encontrado.'];

            return $client;
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function update($id_cliente, array $data, mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];

            $fields = Validator::validate([
                'nome' => $data['nome'] ?? '',
                'data_nascimento' => $data['data_nascimento'] ?? '',
                'rg' => $data['rg'] ?? '',
                'telefone' => $data['telefone'] ?? '',
            ]);

            $client = Client::update($id_cliente[0], $fields);

            if (!$client) return ['error'=> 'Erro ao atualizar cliente.'];

            return "Cliente atualizado!";
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->getMessage()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete(int|string $id, mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];

            $client = Client::delete($id);

            if (!$client) return ['error'=> 'Erro ao deletar cliente.'];

            return "Cliente deletado!";
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