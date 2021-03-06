<?php
require '../vendor/autoload.php';

$router = new Thruway\Peer\Router();
$router->registerModule(new Thruway\Authentication\AuthenticationManager());
$router->addInternalClient(new AuthenticationProvider(["*"]));
$router->addInternalClient(new SessionMonitor(Config::REALM));
$router->addTransportProvider(new Thruway\Transport\RatchetTransportProvider(Config::ADDRESS_TO_SERVE_TO, Config::PORT));
$router->start();