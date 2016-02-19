<?php

namespace Colorium\Http\Error;

class AccessDeniedException extends HttpException
{

	/** @var int */
	protected $code = 401;
}