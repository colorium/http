<?php

namespace Colorium\Http\Error;

use Colorium\Http;

class NotFound extends Http\Error
{

	/** @var int */
	protected $code = 404;
}