<?php

namespace DMM\HTTP;

class RequestTest extends \PHPUnit_Framework_TestCase
{
	public function testSetTimeout()
	{
		$request = new Request();
		$this->assertAttributeSame(10, 'timeout', $request);
		$this->assertSame($request, $request->setTimeout(12345));
		$this->assertAttributeSame(12345, 'timeout', $request);
	}

	public function testSetUserAgent()
	{
		$request = new Request();
		$this->assertAttributeSame('PHP', 'userAgent', $request);
		$this->assertSame($request, $request->setUserAgent('FooBar Client'));
		$this->assertAttributeSame('FooBar Client', 'userAgent', $request);
	}
}
