<?php

namespace Colorium\Http\Response;

use Colorium\Http\Response;

class Redirect extends Response
{

    /** @var string */
    public $uri;


    /**
     * New Redirect Response
     *
     * @param string $uri
     * @param int $code
     * @param array $headers
     */
    public function __construct($uri, $code = 302, array $headers = [])
    {
        parent::__construct(null, $code, $headers);
        $this->uri = (string)$uri;
    }


    /**
     * Send response
     *
     * @return string
     */
    public function send()
    {
        $this->header('Location', $this->uri);
        parent::send();
        exit;
    }

}