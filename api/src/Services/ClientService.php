<?php 

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\Client;
use App\Entity\ClientEntity;

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
                'endereco' => $data['endereco'] ?? ''
            ]);

            $rqst = new ClientEntity();
            $rqst->setNome($fields['nome']);
            $rqst->setData_nascimento($fields['data_nascimento']);
            $rqst->setCpf($fields['cpf']);
            $rqst->setRg($fields['rg']);
            $rqst->setTelefone($fields['telefone']);
            if($rqst->getAddress() !== null) {
                $rqst->setAddress($fields['endereco']);
            }

            $client = Client::save($fields);

            if (!$client) return ['error' => 'Erro ao criar cliente.'];

            return "Cliente criado!";

        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Cliente já existe'];
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
                'endereco' => $data['endereco'] ?? ''
            ]);

            $client = Client::update($id_cliente, $fields);

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