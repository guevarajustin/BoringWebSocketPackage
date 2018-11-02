<?php
require '../vendor/autoload.php';

// keeps track of router's connections with an array
// supports multi connection sessions
class SessionMonitor extends Thruway\Peer\Client {
	
	private $sessions = [];

    public function __construct($realm) {
        parent::__construct($realm);
    }

    public function onSessionStart($session, $transport) {

		$sessions = &$this->sessions;

		$session->subscribe('wamp.metaevent.session.on_join', function($args) use ($session, &$sessions){
			
			// update sessions array
			//
			// if no array exists, create one
			if (!array_key_exists($args[0]->authid,$sessions)) {
				$sessions[$args[0]->authid] = array(
				);
			}
			// record session id in array
			$sessions[$args[0]->authid][$args[0]->session] = 1;

		});

		$session->subscribe('wamp.metaevent.session.on_leave', function($args) use (&$sessions) {

			// update sessions array
			if (array_key_exists($args[0]->authid,$sessions)){
				unset($sessions[$args[0]->authid][$args[0]->session]);
			}
			
			// if no more sessions exist for particular key, we can tell main server that user has disconnected (also remove empty array)
			if (array_key_exists($args[0]->authid,$sessions)){

				if (count($sessions[$args[0]->authid]) === 0) {

					unset($sessions[$args[0]->authid]);

				}
			}

		});
    }
}