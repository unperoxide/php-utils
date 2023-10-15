<?php

/**
 * The Absolute class provides utility methods for handling URLs and file paths.
 */
class Absolute {
    /**
     * Get the current directory URL.
     *
     * @return string The URL of the current directory.
     */
    public static function currectDirectoryURL() {
        return ((!empty($_SERVER['HTTPS'])) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    }

    /**
     * Generate a URL from a relative path.
     *
     * @param string $path The relative path to be converted to a URL.
     * @return string The URL corresponding to the given path.
     */
    public static function url($path = __DIR__) {
        return ((!empty($_SERVER['HTTPS'])) ? 'https://' : 'http://') . self::path(str_replace([
            '\\',
            $_SERVER['DOCUMENT_ROOT'],
        ], [
            '/',
            $_SERVER['SERVER_NAME'],
        ], $path));
    }

    /**
     * Normalize a relative path, resolving any ".." and "." segments.
     *
     * @param string $relativePath The relative path to be normalized.
     * @return string The normalized path.
     * @throws Exception If attempting to climb above the root directory.
     */
    public static function path($relativePath) {
        $path = [];
        foreach (explode('/', $relativePath) as $part) {
            if (empty($part) || $part === '.') {
                continue;
            }

            if ($part !== '..') {
                array_push($path, $part);
            } else if (count($path) > 0) {
                array_pop($path);
            } else {
                throw new Exception('Climbing above the root is not permitted.');
            }
        }
        return join('/', $path);
    }
}
