<?php

namespace Colorium\Http\Error;

class NotFoundException extends HttpException
{

	/** @var int */
	protected $code = 404;
}