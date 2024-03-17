<?php 

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\ClientService;

class ClientController
{
    public function store(Request $request, Response $response)
    {
        $body = $request::body();

        $authorization = $request::authorization();

        $clientService = ClientService::create($body, $authorization);

        if (isset($clientService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $clientService
        ], 201);
    }

    public function fetch(Request $request, Response $response)
    {   
        $authorization = $request::authorization();

        $clientService = ClientService::fetchAll($authorization);

        if (isset($clientService['unauthorized'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['unauthorized']
            ], 401);
        }

        if (isset($clientService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $clientService
        ], 200);
        return;
    }

    public function fetchOne(Request $request, Response $response, array $id_cliente)
    { 
        $authorization = $request::authorization();

        $clientService = ClientService::fetchOne($id_cliente, $authorization);

        if (isset($clientService['unauthorized'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['unauthorized']
            ], 401);
        }

        if (isset($clientService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $clientService
        ], 200);
        return;
    }

    public function update(Request $request, Response $response, array $id_cliente)
    {
        $authorization = $request::authorization();

        $body = $request::body();

        $clientService = ClientService::update($id_cliente[0], $body, $authorization);

        if (isset($clientService['unauthorized'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['unauthorized']
            ], 401);
        }

        if (isset($clientService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => $clientService
        ], 200);
        return;
    }

    public function remove(Request $request, Response $response, array $id)
    {
        $authorization = $request::authorization();

        $clientService = ClientService::delete($id[0], $authorization);

        if (isset($clientService['unauthorized'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['unauthorized']
            ], 401);
        }

        if (isset($clientService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $clientService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => $clientService
        ], 200);
        return;
    }
}