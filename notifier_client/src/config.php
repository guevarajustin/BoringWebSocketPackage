<?php
Class Config {
	
    private function __construct() {
    }
	
	const MAX_CONNECTION_RETRIES = 3;
	const WEBSOCKET_SERVER_URL = 'ws://127.0.0.1:9090/';
	const REALM = 'main_realm';
	const SIGNATURE = "Cd5JwzGnNz8h1ui8Rl70DZp4TEOyJbzR";
	const ROLE = "notifier";
	const AUTHMETHODS = ["regular"];
	const TOPIC = "main";
	const MESSAGE = array("1"=>"");

}