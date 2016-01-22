<?php

namespace Colorium\Http\Error;

use Colorium\Http\Status;

class HttpException extends \Exception
{

	/** @var int */
	protected $code = 500;

	/** @var string */
	protected $message = Status::_500;
}