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
	
	// publish notification
	$session->publish(Config::TOPIC, [Config::MESSAGE], [], ["acknowledge" => true])->then(
		function () use ($connection) {
			$connection->close(); // close connection after publish attempt
		},
		function ($error) use ($connection) {
			$connection->close(); // close connection after publish attempt
		}
	);
	
});

$connection->open();