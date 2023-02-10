<?php namespace App\Controllers;

use OAuth2\Request;
use CodeIgniter\API\ResponseTrait;
use App\Models\User_credentials;

class Authorize extends BaseController {

    use ResponseTrait;
    var $respond;
    var $token;

    function index()
    {
        return view('authorization');
    }

    public function confirmation()
	{
		$request 	= new Request();
		$respond 	= $this->OAuth->authorization_code()->handleTokenRequest($request->createFromGlobals());
		$code 		= $respond->getStatusCode();
		$body 		= $respond->getResponseBody();

		return $this->respond(json_decode($body),$code);
	}

	public function client_credentials()
	{
		$request 	= new Request();
		$respond 	= $this->OAuth->client_credentials()->handleTokenRequest($request->createFromGlobals());
		$code 		= $respond->getStatusCode();
		$body 		= $respond->getResponseBody();
		return $this->respond(json_decode($body),$code);
	}

	public function user_credentials()
	{
        $request	= new Request();
        
        $username = $this->request->getPost("username") ;
        $password = $this->request->getPost("password");
        $arr_user = array(
            "username" => $username,
            "password" => $password
        );

		$usermodel 	= new User_credentials();
		
		$respond	= $this->OAuth->user_credentials($usermodel->find_user($arr_user))->handleTokenRequest($request->createFromGlobals());
		
        $code 		= $respond->getStatusCode();
		$body 		= $respond->getResponseBody();

		return $this->respond(json_decode($body),$code);
		
	}

	public function refresh_token()
	{
		$request 	= new Request();
		$respond 	= $this->OAuth->refresh_token()->handleTokenRequest($request->createFromGlobals());

		$code		= $respond->getStatusCode();
		$body 		= $respond->getResponseBody();
		
		return $this->respond(json_decode($body),$code);
	}

}