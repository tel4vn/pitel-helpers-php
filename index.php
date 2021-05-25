<?php

class PitelHelpers {

    function __construct(string $PITEL_API_KEY, string $PITEL_SECRET_KEY, string $PITEL_USERID) {
        $this->_API_KEY = $PITEL_API_KEY;
        $this->_SECRET_KEY = $PITEL_SECRET_KEY;
        $this->_USERID = $PITEL_USERID;

        if(!$this->_API_KEY) {
            throw new ErrorException("PITEL_API_KEY is required");
        }
        if(!$this->_SECRET_KEY) {
            throw new ErrorException("PITEL_SECRET_KEY is required");
        }
        if(!$this->_USERID) {
            throw new ErrorException("PITEL_USERID is required");
        }

    }

    function getAccessToken() {
        $exp = time() + 3600;

        $payload = array(
            "key" => $this->_API_KEY,
            "exp" => $exp,
            "uid" => $this->_USERID
        );
        // Create token header as a JSON string
        // $header = json_encode(['org' => 'pitel-helpers-python;version=1', '']);
        $header = json_encode(['org' => 'pitel', 'ver' =>'1', 'typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode($payload);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->_SECRET_KEY, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }
}
?>