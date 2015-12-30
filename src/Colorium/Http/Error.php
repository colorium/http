<?php

namespace Colorium\Http;

class Error extends \Exception
{

	/** @var int */
	protected $code = 500;
}