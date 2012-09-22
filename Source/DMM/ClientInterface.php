<?php

namespace DMM;

interface ClientInterface
{
	/**
	 * Return new Client object
	 * @param string $appId
	 * @param string $affiliateId
	 */
	public function __construct($appId, $affiliateId);

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
	public function request(array $query);
}
