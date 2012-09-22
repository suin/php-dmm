<?php

namespace DMM\HTTP;

use \DMM\HTTP\Response;
use \DMM\HTTP\Exception as HTTPException;

class Request implements \DMM\HTTP\RequestInterface
{
	/** @var int */
	protected $timeout = 10;
	/** @var string */
	protected $userAgent = 'PHP';

	/**
	 * Set timeout
	 * @param int $timeout Seconds for timeout
	 * @return $this
	 */
	public function setTimeout($timeout)
	{
		$this->timeout = $timeout;
		return $this;
	}

	/**
	 * Set user agent
	 * @param string $userAgent
	 * @return $this
	 */
	public function setUserAgent($userAgent)
	{
		$this->userAgent = $userAgent;
		return $this;
	}

	/**
	 * Execute request
	 * @param string $url
	 * @param string $method
	 * @return \DMM\HTTP\ResponseInterface
	 * @throws \DMM\HTTP\Exception
	 */
	public function execute($url, $method)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);

		$result = curl_exec($ch);
		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ( $result === false )
		{
			throw HTTPException::connectionError(curl_error($ch));
		}

		curl_close($ch);

		return new Response($result, $statusCode);
	}
}
