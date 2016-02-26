<?php

namespace Colorium\Http\Error;

class ServiceUnavailable extends HttpException
{


    /** @var int */
    protected $code = 503;
}