<?php
namespace App\Traits;

use App\Person;
use App\User;
use Exception;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

trait ValidateTraits
{
    public static function validateUser($token = null)
    {
        $token = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        if (!$token) {
            throw new Exception('Token not supplied');
        }
        $key = getenv('JWT_SEC_KEY');
        $signer = new Sha256();
        try {
            $token = (new Parser())->parse((string) $token);
            $data = new ValidationData();
            $data->setIssuer('HTTP_SERVER');
            $data->setId('4f1g23a12aa');
            if (!$token->validate($data) || !$token->verify($signer, $key)) {
                throw new Exception('Token has expired');
            }
            return true;
        } catch (\Throwable $th) {
            throw new Exception('Invalid token');
        }
    }
}