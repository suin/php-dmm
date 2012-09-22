<?php

namespace DMM\HTTP;

class Exception extends \RuntimeException
{
	public static function connectionError($reason)
	{
		return new self(sprintf('Connection error: %s', $reason));
	}
}
