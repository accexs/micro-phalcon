<?php

namespace App\Services;

use \Firebase\JWT\JWT;

abstract class AuthService
{
    
    public static function authenticate($token, $config)
    {
        if (empty($token)) {
            throw new \Exception("Error no authentication token", 1);
        }

        // example on how to generate the token programmatically
        /*$token = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );
        $jwt = JWT::encode($token, $key);*/
        
        $token = str_replace('Bearer ', '', $token);
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $decoded = JWT::decode($token, $config->jwt->key, array('HS256'));

        /*
         NOTE: This will now be an object instead of an associative array. To get
         an associative array, you will need to cast it as such:
        */
        $decoded_array = (array) $decoded;

        /**
         * You can add a leeway to account for when there is a clock skew times between
         * the signing and verifying servers. It is recommended that this leeway should
         * not be bigger than a few minutes.
         *
         * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
         */
        //JWT::$leeway = 60; // $leeway in seconds
        //$decoded = JWT::decode($jwt, $key, array('HS256'));
        return true;
    }
}
