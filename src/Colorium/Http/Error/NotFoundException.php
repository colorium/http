<?php

namespace Colorium\Http\Error;

use Colorium\Http\Status;

class NotFoundException extends HttpException
{

	/** @var int */
	protected $code = 404;
}