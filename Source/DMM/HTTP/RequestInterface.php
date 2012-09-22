<?php

namespace DMM\HTTP;

interface RequestInterface
{
	/**
	 * Set timeout
	 * @param int $timeout Seconds for timeout
	 * @return $this
	 */
	public function setTimeout($timeout);

	/**
	 * Set user agent
	 * @param string $userAgent
	 * @return $this
	 */
	public function setUserAgent($userAgent);

	/**
	 * Execute request
	 * @param string $url
	 * @param string $method
	 * @return \DMM\HTTP\ResponseInterface
	 * @throws \DMM\HTTP\Exception
	 */
	public function execute($url, $method);
}
