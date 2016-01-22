<?php

namespace Colorium\Http\Error;

use Colorium\Http\Status;

class NotFoundException extends HttpException
{

	/** @var int */
	protected $code = 404;

	/** @var string */
	protected $message = Status::_404;
}