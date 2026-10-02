<?php
namespace App\Helpers;
use Exception;

class Signer
{
    private static mixed $privateKey = null;
    public static function setup(): void
    {
        $keyPath = storage_path('app/private/keys/PrivateKey_1024.pem');
        if (!file_exists($keyPath)) {
            throw new Exception('Private key not found at ' . $keyPath);
        }
        self::$privateKey = openssl_pkey_get_private(file_get_contents($keyPath));
        if (!self::$privateKey) {
            throw new Exception('Failed to load private key: ' . openssl_error_string());
        }
    }

    private static function getKey(): mixed
    {
        if (!self::$privateKey) {
            self::setup();
        }
        return self::$privateKey;
    }

    public static function signString(string $data, bool $useRbxSig = false): string
    {
        openssl_sign($data, $signature, self::getKey(), OPENSSL_ALGO_SHA1);
        if ($useRbxSig) {
            return sprintf("--rbxsig%%%s%%\r\n%s", base64_encode($signature), $data);
        }
        return base64_encode($signature);
    }

    public static function signJson(mixed $data): string
    {
        $script = "\r\n" . json_encode($data);
        openssl_sign($script, $signature, self::getKey(), OPENSSL_ALGO_SHA1);
        return sprintf('--rbxsig%%%s%%%s', base64_encode($signature), $script);
    }
}