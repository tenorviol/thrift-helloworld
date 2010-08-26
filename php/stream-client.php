<?php

$GLOBALS['THRIFT_ROOT'] = '/usr/local/thrift-0.2.0/lib/php/src';

require_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';
require_once $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TPhpStream.php';

require_once $GLOBALS['THRIFT_ROOT'].'/packages/helloworld/HelloWorld.php';

$stdout = new TPhpStream(TPhpStream::MODE_W);
$protocol = new TBinaryProtocol($stdout);
$client = new HelloWorldClient($protocol);

$stdout->open();

$send = implode(' ', array_slice($_SERVER['argv'], 1));
$client->send($send);
