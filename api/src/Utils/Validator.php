<?php

namespace App\Utils;

class Validator 
{
    public static function validate(array $fields)
    {
        foreach ($fields as $field => $value) {
            if (is_array($value)) {
                foreach ($value as $index => $nvalue) {
                    if (empty(trim($nvalue))) {
                        throw new \Exception("The field ($index) is required.");
                    }
                }
            } else {
                if (empty(trim($value)) && $field != "endereco") {
                    throw new \Exception("The field ($field) is required.");
                }
            }
            
        }

        return $fields;
    }
}