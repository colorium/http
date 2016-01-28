<?php

namespace Colorium\Http\Error;

use Colorium\Http\Status;

class NotImplementedException extends HttpException
{

	/** @var int */
	protected $code = 501;

	/** @var string */
	protected $message = Status::_501;
}