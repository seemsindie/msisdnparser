<?php

require_once __DIR__ . '/../vendor/autoload.php';

use JsonRPC\Server;

$parser = new \Msisdn\Parser();

$server = new Server();

$procedureHandler = $server->getProcedureHandler();
$procedureHandler->withObject($parser);

echo $server->execute();
