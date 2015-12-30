<?php

namespace Colorium\Http\Response;

use Colorium\Http\Response;

class Template extends Response
{

    /** @var string */
    public $template;

    /** @var array */
    public $vars = [];


    /**
     * New Template Response
     *
     * @param string $template
     * @param array $vars
     * @param int $code
     * @param array $headers
     */
    public function __construct($template, array $vars = [], $code = 200, array $headers = [])
    {
        parent::__construct(null, $code, $headers);
        $this->template = $template;
        $this->vars = $vars;
    }

}