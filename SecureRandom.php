<?php

/**
 * SecureRandom
 *
 * @author Nov Matake <nov@matake.jp>
 */

class SecureRandomException extends Exception {
}

class SecureRandom
{
    const DEFAULT_BYTE_LENGTH = 32;

    public static function bytes($byte_length = self::DEFAULT_BYTE_LENGTH)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            return openssl_random_pseudo_bytes($byte_length);
        } else {
            $openssl_path = exec("which openssl", $_trash);
            if ($openssl_path == false) {
                throw new SecureRandomException("OpenSSL not found.");
            } else {
                $fp = popen("$openssl_path rand $byte_length", "r");
                if ($fp === false) {
                    throw new SecureRandomException("OpenSSL not available.");
                } else {
                    $bytes = stream_get_contents($fp);
                    pclose($fp);
                    return $bytes;
                }
            }
        }
    }

    public static function hex($byte_length = self::DEFAULT_BYTE_LENGTH)
    {
        return bin2hex(self::bytes($byte_length));
    }

    public static function base64($byte_length = self::DEFAULT_BYTE_LENGTH)
    {
        return base64_encode(self::bytes($byte_length));
    }
}
