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

        $clientService = ClientService::create($body);

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
        $clientService = ClientService::fetchAll();

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
        $clientService = ClientService::fetchOne($id_cliente);

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

        $body = $request::body();

        $clientService = ClientService::update($id_cliente[0], $body);

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

        $clientService = ClientService::delete($id[0]);

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