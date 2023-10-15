<?php

/**
 * A utility class for typecasting variables.
 */
class TypeCaster {
    /**
     * Typecast a variable, array, or object.
     *
     * @param mixed $data The variable, array, or object to be typecasted.
     * @return mixed The typecasted result.
     */
    public static function cast($data) {
        if (gettype($data) === 'object') {
            return (object) self::typeCastArray((array) $data);
        }

        if (gettype($data) === 'array') {
            return self::typeCastArray($data);
        }

        return self::typeCast($data);
    }

    /**
     * Typecast a single variable.
     *
     * @param mixed $variable The variable to be typecasted.
     * @return mixed The typecasted result.
     */
    private static function typeCast($variable) {
        if ($variable === 'null') {
            return null;
        } elseif (is_numeric($variable)) {
            return $variable + 0;
        } elseif (gettype($variable) === 'string' && strtolower($variable) === 'true') {
            return true;
        } elseif (gettype($variable) === 'string' && strtolower($variable) === 'false') {
            return false;
        }
        return $variable;
    }

    /**
     * Typecast an array of variables.
     *
     * @param array $array The array of variables to be typecasted.
     * @return array The typecasted array.
     */
    private static function typeCastArray($array) {
        return array_map('self::typeCast', $array);
    }
}
