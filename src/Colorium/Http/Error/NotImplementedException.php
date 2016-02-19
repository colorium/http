<?php

namespace Colorium\Http\Error;

class NotImplementedException extends HttpException
{

	/** @var int */
	protected $code = 501;
}