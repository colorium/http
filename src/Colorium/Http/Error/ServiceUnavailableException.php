<?php

namespace Colorium\Http\Error;

class ServiceUnavailableException extends HttpException
{

    /** @var int */
    protected $code = 503;
}