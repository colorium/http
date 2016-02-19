<?php

namespace Colorium\Http\Error;

class HttpException extends \Exception
{

	/** @var int */
	protected $code = 500;
}