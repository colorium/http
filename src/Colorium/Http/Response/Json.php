<?php

namespace Colorium\Http\Response;

use Colorium\Http\Response;

class Json extends Response
{

	/** @var string */
    public $format = 'application/json';


    /**
     * New JSON Response
     *
     * @param string $content
     * @param int $code
     * @param array $headers
     */
    public function __construct($content = null, $code = 200, array $headers = [])
    {
        $content = json_encode($content, JSON_PRETTY_PRINT);
        parent::__construct($content, $code, $headers);
    }

}