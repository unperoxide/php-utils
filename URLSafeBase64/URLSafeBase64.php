<?php

class URLSafeBase64 {
    /**
     * Encode a string with URL-safe Base64.
     *
     * @param string $input The string you want encoded
     *
     * @return string The base64 encode of what you passed in
     * 
     * @link https://github.com/firebase/php-jwt/blob/feb0e820b8436873675fd3aca04f3728eb2185cb/src/JWT.php#L350
     */
    public static function encode($input)
    {
        return \str_replace('=', '', \strtr(\base64_encode($input), '+/', '-_'));
    }

    /**
     * Decode a string with URL-safe Base64.
     *
     * @param string $input A Base64 encoded string
     *
     * @return string A decoded string
     * 
     * @link https://github.com/firebase/php-jwt/blob/feb0e820b8436873675fd3aca04f3728eb2185cb/src/JWT.php#L333
     */
    public static function decode($input)
    {
        $remainder = \strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= \str_repeat('=', $padlen);
        }
        return \base64_decode(\strtr($input, '-_', '+/'));
    }
}
