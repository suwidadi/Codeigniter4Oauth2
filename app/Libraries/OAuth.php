<?php namespace App\Libraries;

use OAuth2;
use OAuth2\Storage\Pdo;
use OAuth2\Request;
use OAuth2\Server;


class OAuth {

    var $storage;
    var $server;
    var $respond;
    
    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $dsn                = getenv('database.default.dsn');
        $username           = getenv('database.default.username');
        $password           = getenv('database.default.password');
    
        $this->storage      = new Pdo(array('dsn'=>$dsn,'username'=>$username,'password'=>$password));
        $this->server       = new Server($this->storage,array('allow_implicit'=>true));   
    }

    public function client_credentials()
    {
        $this->server->addGrantType(new Oauth2\GrantType\ClientCredentials($this->storage));
        return $this->server;
    }

    public function user_credentials($infouser)
    {
        $this->storage = new OAuth2\Storage\Memory(array('user_credentials'=>$infouser));
        $this->server->addGrantType(new Oauth2\GrantType\UserCredentials($this->storage));
        
        return $this->server;
    }

    public function authorization_code()
    {
        $this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($this->storage));
        return $this->server;
    }

    public function refresh_token()
    {
        $this->server->addGrantType(new OAuth2\GrantType\RefreshToken($this->storage, array(
            "always_issue_new_refresh_token" => true,
            "unset_refresh_token_after_use" => true,
            "refresh_token_lifetime" => 3600,
        )));
        return $this->server;
    }

    /**
     * validate bearer token submitted with request
     * 
     * @param bearer $token
     * 
     * when user request this will validate bearer token within the request
     * 
     * @return array token info if passed and error message when not passed
     * 
     */
    public function validate_request()
    {
        $request = new Request();
        
        if (!$this->server->verifyResourceRequest($request->createFromGlobals()))
        {
            $this->server->getResponse()->send();
            die();
        }

        return $this->server->getAccessTokenData($request->createFromGlobals());
        
    }
}