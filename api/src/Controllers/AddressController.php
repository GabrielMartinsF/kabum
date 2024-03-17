<?php 

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\AddressService;

class AddressController
{
    public function store(Request $request, Response $response)
    {
        $body = $request::body();

        $addressService = AddressService::create($body);

        if (isset($addressService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $addressService
        ], 201);
    }

    public function fetch(Request $request, Response $response)
    {
        $addressService = AddressService::fetchAll();

        if (isset($addressService['unauthorized'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['unauthorized']
            ], 401);
        }

        if (isset($addressService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $addressService
        ], 200);
        return;
    }

    public function fetchOne(Request $request, Response $response, array $id_cliente)
    { 
        $clientService = AddressService::fetchOne($id_cliente);

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

        $addressService = AddressService::update($id_cliente, $body);

        if (isset($addressService['unauthorized'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['unauthorized']
            ], 401);
        }

        if (isset($addressService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => $addressService
        ], 200);
        return;
    }

    public function remove(Request $request, Response $response, array $id)
    {
        $addressService = AddressService::delete($id[0]);

        if (isset($addressService['unauthorized'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['unauthorized']
            ], 401);
        }

        if (isset($addressService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => $addressService
        ], 200);
        return;
    }
}