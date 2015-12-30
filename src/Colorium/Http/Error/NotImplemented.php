<?php

namespace Colorium\Http\Error;

use Colorium\Http;

class NotImplemented extends Http\Error
{

	/** @var int */
	protected $code = 501;
}