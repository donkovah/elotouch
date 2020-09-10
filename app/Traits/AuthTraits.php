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

trait AuthTraits
{
    public function login()
    {
        $req = json_decode(file_get_contents('php://input'), true);
        $email = filter_var($req['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($req['password'], FILTER_SANITIZE_STRING);
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid Email');
        }
        $user = User::where('email', $email)->first();
        if(!$user){
            throw new Exception('User does not exist');
        }
        if ($user->password !== $password) {
            throw new Exception('Incorrect user deatils');
        }

        $email = $this->request->post['email'] ?? '';
        $time = time();
        $signer = new Sha256();
        $time = time();
        $key = new Key('JWT_SEC_KEY');
        
        $token = (new Builder())->issuedBy(getenv('HTTP_SERVER')) // Configures the issuer (iss claim)
                                ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                                ->issuedAt($time) // Configures the time that the token was issue (iat claim)
                                ->canOnlyBeUsedAfter($time + 1) // Configures the time that the token can be used (nbf claim)
                                ->expiresAt($time + 86400) // Configures the expiration time of the token (exp claim)
                                ->withClaim('uid', $email) // Configures a new claim, called "uid"
                                ->getToken($signer, $key); // Retrieves the generated token
        $res = ["token" => $token->__toString()];       
        return $res;
    }

}