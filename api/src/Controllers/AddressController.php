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

        $authorization = $request::authorization();

        $addressService = AddressService::create($body, $authorization);

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
        $authorization = $request::authorization();

        $addressService = AddressService::fetchAll($authorization);

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
        $authorization = $request::authorization();

        $clientService = AddressService::fetchOne($id_cliente, $authorization);

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

        $authorization = $request::authorization();

        $addressService = AddressService::update($id_cliente, $body, $authorization);

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
        $authorization = $request::authorization();

        $addressService = AddressService::delete($id[0], $authorization);

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