<?php
namespace App\Controller;

class Authcontroller
{
    
    public function login()
    {
        $email = $this->request->post['email'] ?? '';
        $password = $this->request->post['password'] ?? '';
        $file_loc = DIR_APP.'APIdb/users.json';
        $users = file_get_contents($file_loc, true);
        if(!$users){
            return  $this->response->setOutput(json_encode(['message' => 'User does not exist']));
        }
        $users = json_decode($users, true);
        $user = array_search($email, array_column($users, 'email'));
        if($user === false){
            return  $this->response->setOutput(json_encode(['message' => 'User not found']));
        }
        $user = $users[$user];
        if($user['password'] !== $password ){
            return  $this->response->setOutput(json_encode(['message' => 'Authentication failed']));
        }
        $time = time();
        $signer = new Sha256();
        $time = time();
        $key = new Key(getenv('JWT_SEC_KEY'));
        
        $token = (new Builder())->issuedBy(HTTP_SERVER) // Configures the issuer (iss claim)
                                ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                                ->issuedAt($time) // Configures the time that the token was issue (iat claim)
                                ->canOnlyBeUsedAfter($time + 1) // Configures the time that the token can be used (nbf claim)
                                ->expiresAt($time + 86400) // Configures the expiration time of the token (exp claim)
                                ->withClaim('uid', $email) // Configures a new claim, called "uid"
                                ->getToken($signer, $key); // Retrieves the generated token
        
        $res = ["token" => $token->__toString()];        
        return  $this->response->setOutput(json_encode($res));
    }

    private function validateToken($token)
    {
        if (!$token) {
            $this->response->addHeader('Content-Type: application/json');
            return ['status' => 404, 'message' => "Token not supplied"];
        }

        $key = getenv('JWT_SEC_KEY');
        $signer = new Sha256();
        try {
            $token = (new Parser())->parse((string) $token);
            $data = new ValidationData();
            $data->setIssuer(HTTP_SERVER);
            $data->setId('4f1g23a12aa');
            if (!$token->validate($data) || !$token->verify($signer, $key)) {
                return ['status' => 404, 'message' => "Token expired"];
            }
            return ['status' => 200, 'message' => "Token valid"];
        } catch (\Throwable $th) {
            return ['status' => 404, 'message' => "Invalid token"];
        }
    }
}