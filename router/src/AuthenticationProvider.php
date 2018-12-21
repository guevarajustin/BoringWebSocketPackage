<?php
require '../vendor/autoload.php';

class AuthenticationProvider extends Thruway\Authentication\AbstractAuthProviderClient {
	
	private $methodName = "regular";

    public function getMethodName() {
        return $this->methodName;
    }
	
    public function processAuthenticate($signature, $extra = null) {

		// retrieve role
		// return failure if invalid role provided *TBD
		$role = $signature->role;
		$role_is_valid = true; // always true since validation hasn't been implemented

		if ($role_is_valid === false) {
			return ["FAILURE"];
		}

		// authenticate signature *TBD
		$the_key = $signature->signature;
		$the_key_is_valid = true; // always true since validation hasn't been implemented
		if ($the_key_is_valid === false) {
			return ["FAILURE"];
		}
	
		$details = ["authid" => $the_key];
		return ["SUCCESS", $details];

    }
	
}