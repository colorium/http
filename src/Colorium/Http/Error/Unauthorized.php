<?php

namespace Colorium\Http\Error;

use Colorium\Http;

class Unauthorized extends Http\Error
{

	/** @var int */
	protected $code = 401;
}