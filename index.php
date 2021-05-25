<?php
use Firebase\JWT\JWT;
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
        $exp = floor(time.time()) + 3600;

        $payload = array(
            "key" => $this->_API_KEY,
            "exp" => $exp,
            "uid" => $this->_USERID
        );

        $token = JWT::encode($payload, $this->_SECRET_KEY, 'RS256');
        return $token;

    }
}
?>