<?php

namespace DMM;

use \Mockery as m;
use \Expose\Expose as e;

class ClientTest extends \PHPUnit_Framework_TestCase
{
	public function test__construct()
	{
		$client = new Client('API-id', 'affiliate-id');
		$this->assertAttributeSame('API-id', 'apiId', $client);
		$this->assertAttributeSame('affiliate-id', 'affiliateId', $client);
	}

	public function testRequest()
	{
		$xml = '<?xml version="1.0" encoding="euc-jp"?>
<responce>
	<result>
		<count>20</count>
		<items>
			<item>
				<name>foo</name>
			</item>
			<item>
				<name>bar</name>
			</item>
		</items>
	</result>
</responce>';
		$expect = array(
			'result' => array(
				'count' => '20',
				'items' => array(
					'item' => array(
						array(
							'name' => 'foo',
						),
						array(
							'name' => 'bar',
						),
					),
				),
			),
		);

		$query = array(
			'keyword' => '日本語',
		);

		$apiId = 'app-id';
		$affiliateId = 'affiliate-id';

		$options = array(
			'api_id'       => $apiId,
			'affiliate_id' => $affiliateId,
			'operation'    => 'ItemList',
			'version'      => '1.00',
			'timestamp'    => date('Y-m-d H:i:s'),
			'site'         => 'DMM.com',
			'keyword'      => mb_convert_encoding($query['keyword'], 'EUC-JP', 'UTF-8'),
		);

		$url = 'http://affiliate-api.dmm.com/?'.http_build_query($options);

		$response = m::mock('\DMM\HTTP\ResponseInterface');
		$response->shouldReceive('getData')->andReturn($xml)->once();

		$request = m::mock('\DMM\HTTP\RequestInterface');
		$request->shouldReceive('execute')->with($url, 'GET')->andReturn($response)->once();

		$client = $this->getMock('\DMM\Client', array('_newHTTPRequest'), array($apiId, $affiliateId));
		$client
			->expects($this->once())
			->method('_newHTTPRequest')
			->will($this->returnValue($request));

		$this->assertSame($expect, $client->request($query));
	}

	public function test_newHTTPRequest()
	{
		$client = new Client('foo', 'bar');
		$this->assertInstanceOf('\DMM\HTTP\RequestInterface', e::expose($client)->call('_newHTTPRequest'));
	}
}
