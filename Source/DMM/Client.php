<?php

namespace DMM;

use \DMM\HTTP\Request;
use \SimpleXMLElement;

class Client implements \DMM\ClientInterface
{
	/** @var string */
	protected $apiId;
	/** @var string */
	protected $affiliateId;

	/**
	 * Return new Client object
	 * @param string $apiId
	 * @param string $affiliateId
	 */
	public function __construct($apiId, $affiliateId)
	{
		$this->apiId = $apiId;
		$this->affiliateId = $affiliateId;
	}

	/**
	 * Request items to DMM API
	 * @param array $query
	 *
	 * Available queries
	 *  service: サービス
	 *  floor: フロア
	 *  hits: 取得件数
	 *  offset: 検索開始位置
	 *  sort: ソート順
	 *  keyword: キーワード
	 *
	 * @return array
	 */
	public function request(array $query)
	{
		$query = array(
			'api_id'       => $this->apiId,
			'affiliate_id' => $this->affiliateId,
			'operation'    => 'ItemList',
			'version'      => '1.00',
			'timestamp'    => date('Y-m-d H:i:s'),
			'site'         => 'DMM.com',
		) + $query;
		$query['keyword'] = mb_convert_encoding($query['keyword'], 'EUC-JP', 'UTF-8');

		$url = 'http://affiliate-api.dmm.com/?'.http_build_query($query);

		$request = $this->_newHTTPRequest();
		$response = $request->execute($url, 'GET');
		$xml = $response->getData();

		return json_decode(json_encode(new SimpleXMLElement(mb_convert_encoding($xml, 'EUC-JP', 'EUC-JP'))), true);
	}

	/**
	 * @return \DMM\HTTP\Request
	 */
	protected function _newHTTPRequest()
	{
		return new Request();
	}
}
