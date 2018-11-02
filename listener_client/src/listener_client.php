<?php
require '../vendor/autoload.php';

$connection = new Thruway\Connection([
	"max_retries" => Config::MAX_CONNECTION_RETRIES,
	"realm" => Config::REALM,	
	"url" => Config::WEBSOCKET_SERVER_URL,
	"onChallenge" => function () {
		return array(
			"signature"=>Config::SIGNATURE,
			"role"=>Config::ROLE
		);
	},
	"authmethods" => Config::AUTHMETHODS,
]);

$connection->on('open', function (Thruway\ClientSession $session) use ($connection) {
	
	$session->subscribe(Config::TOPIC, function () {
		echo "Notification recieved";
	});

});

$connection->open();