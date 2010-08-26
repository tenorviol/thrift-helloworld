<?php

$GLOBALS['THRIFT_ROOT'] = '/usr/local/thrift-0.2.0/lib/php/src';

require_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';
require_once $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TPhpStream.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TBufferedTransport.php';

require_once $GLOBALS['THRIFT_ROOT'].'/packages/helloworld/HelloWorld.php';

class HelloWorldHandler implements HelloWorldIf {
	public function send($juicy) {
		$time = time();
		echo "$time\t$juicy\n";
	}
}

$handler = new HelloWorldHandler();
$processor = new HelloWorldProcessor($handler);
$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();
