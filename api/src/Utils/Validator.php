<?php

namespace App\Utils;

class Validator 
{
    public static function validate(array $fields)
    {
        foreach ($fields as $field => $value) {
            if (is_array($value)) {
                foreach ($value as $index => $nvalue) {
                    if (empty(trim($nvalue)) && $index !== "logradouro_complemento") {
                        throw new \Exception("O campo $index é obrigatório.");
                    }
                }
            } else {
                if (empty(trim($value)) && $field != "endereco" && $field !== "logradouro_complemento") {
                    throw new \Exception("O campo $field é obrigatório.");
                }
            }
            
        }

        return $fields;
    }
}