<?php 

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\Address;
use App\Entity\AddressEntity;

class AddressService
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
                'logradouro' => $data['logradouro'] ?? '',
                'logradouro_numero' => $data['logradouro_numero'] ?? '',
                'logradouro_bairro' => $data['logradouro_bairro'] ?? '',
                'logradouro_cep' => $data['logradouro_cep'] ?? '',
                'logradouro_cidade' => $data['logradouro_cidade'] ?? '',
                'logradouro_estado' => $data['logradouro_estado'] ?? '',
                'id_cliente' => $data['id_cliente'] ?? '',
            ]);

            $rqst = new AddressEntity();
            $rqst->setLogradouro($fields['logradouro']);
            $rqst->setLogradouro_numero($fields['logradouro_numero']);
            $rqst->setLogradouro_complemento($fields['logradouro_complemento']);
            $rqst->setLogradouro_bairro($fields['logradouro_bairro']);
            $rqst->setLogradouro_cep($fields['logradouro_cep']);
            $rqst->setlogradouro_cidade($fields['logradouro_cidade']);
            $rqst->setLogradouro_estado($fields['logradouro_estado']);
            $rqst->setId_cliente($fields['id_cliente']);

            $address = Address::save($fields);

            if (!$address) return ['error' => 'Erro ao criar endereço.'];

            return "endereço criado!";

        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'endereço já existe'];
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
            
            $address = Address::find();

            return $address;
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetchOne(array $id_endereco, mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];
            
            $address = Address::findOne($id_endereco[0]);

            if (!$address) return ['error'=> 'endereço não encontrado.'];

            return $address;
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Erro de conexão.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function update($id_endereco, array $data, mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "Faça login para acessar."];

            $fields = Validator::validate([
                'logradouro' => $data['logradouro'] ?? '',
                'logradouro_numero' => $data['logradouro_numero'] ?? '',
                'logradouro_complemento' => $data['logradouro_complemento'] ?? '',
                'logradouro_bairro' => $data['logradouro_bairro'] ?? '',
                'logradouro_cep' => $data['logradouro_cep'] ?? '',
                'logradouro_cidade' => $data['logradouro_cidade'] ?? '',
                'logradouro_estado' => $data['logradouro_estado'] ?? '',
            ]);

            $address = Address::update($id_endereco, $fields);

            if (!$address) return ['error'=> 'Erro ao atualizar endereço.'];

            return "endereço atualizado!";
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

            $address = Address::delete($id);

            if (!$address) return ['error'=> 'Erro ao deletar endereço.'];

            return "endereço deletado!";
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