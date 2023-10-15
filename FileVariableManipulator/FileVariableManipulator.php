<?php

/**
 * A utility class for extracting and replacing variables in PHP files.
 */
class FileVariableManipulator {
    /**
     * Extract variables from a PHP file.
     *
     * @param string $path The path to the PHP file.
     * @return array An associative array of variable names and their values.
     */
    public static function extractFileVariables($path) {
        $tokens = token_get_all(file_get_contents($path));
        $variables = [];

        $tempVar = null;

        foreach ($tokens as $token) {
            if (!is_array($token)) {
                continue;
            }

            $value = trim($token[1], "'\"");

            if ($token[0] === T_VARIABLE) {
                $tempVar = substr($value, 1);
            }

            if (!isset($variables[$tempVar]) && $tempVar !== null && in_array($token[0], [T_CONSTANT_ENCAPSED_STRING, T_LNUMBER, T_DNUMBER], true)) {
                $variables[$tempVar] = $value;
                $tempVar = null;
            }
        }

        return $variables;
    }

    /**
     * Replace variables in a PHP file with provided values.
     *
     * @param string $path The path to the PHP file.
     * @param array $replacement An associative array of variable names and their new values.
     * @return int|false The number of bytes written to the file, or false on failure.
     */
    public static function replaceFileVariables($path, $replacement) {
        $content = file_get_contents($path);

        $extractedVariables = self::extractFileVariables($path);

        foreach ($replacement as $key => $value) {
            $content = strtr($content, [
                $extractedVariables[$key] => $value
            ]);
        }

        return file_put_contents($path, $content);
    }

    /**
     * Replace variables in a PHP file using regular expressions.
     *
     * @param string $path The path to the PHP file.
     * @param array $replacement An associative array of variable names and their new values.
     * @return int|false The number of bytes written to the file, or false on failure.
     */
    public static function replaceFileVariablesRegex($path, $replacement = []) {
        $content = file_get_contents($path);

        foreach ($replacement as $key => $value) {
            $content = preg_replace('/\$' . $key . '\s?=\s?(\'|\")?(.*?)(\'|\")?;/', '$' . $key . ' = $1' . $value . '$3;', $content);
        }

        return file_put_contents($path, $content);
    }
}
