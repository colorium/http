<?php

namespace Colorium\Http\Error;

use Colorium\Http\Status;

class UnauthorizedException extends HttpException
{

	/** @var int */
	protected $code = 401;

	/** @var string */
	protected $message = Status::_401;
}