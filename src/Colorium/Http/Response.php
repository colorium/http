<?php

namespace Colorium\Http;

class Response
{

    /** @var int */
    public $code = 200;

    /** @var string */
    public $format = 'text/plain';

    /** @var string */
    public $charset = 'utf-8';

    /** @var array */
    public $headers = [];

    /** @var string */
    public $content;

    /** @var bool */
    public $raw = false;


    /**
     * New Response
     *
     * @param string $content
     * @param int $code
     * @param array $headers
     */
    public function __construct($content = null, $code = 200, array $headers = [])
    {
        $this->content = $content;
        $this->code = $code;

        foreach($headers as $header  =>  $value) {
            $this->header($header, $value);
        }
    }


    /**
     * Set header
     *
     * @param string $name
     * @param string $value
     * @param bool $replace
     *
     * @return $this
     */
    public function header($name, $value, $replace = true)
    {
        $name = strtolower($name);
        if(isset($this->headers[$name]) and !$replace) {
            if(is_array($this->headers[$name])) {
                array_push($this->headers[$name], $value);
            }
            else {
                $this->headers[$name] = [
                    $this->headers[$name],
                    $value
                ];
            }
        }
        else {
            $this->headers[$name] = $value;
        }

        return $this;
    }


    /**
     * Set cookie
     *
     * @param string $name
     * @param string $value
     * @param int $expires
     *
     * @return $this
     */
    public function cookie($name, $value, $expires = 0)
    {
        $cookie = urlencode($name);

        // has value
        if($value) {
            $cookie .= '=' . urlencode($value) . ';';
            $cookie .= ' expires=' . gmdate("D, d-M-Y H:i:s T", time() - 31536001) . ';';
        }
        // delete cookie
        else {
            $cookie .= '=deleted;';
            if($expires) {
                $cookie .= ' expires=' . gmdate("D, d-M-Y H:i:s T", time() - $expires);
            }
        }

        return $this->header('Set-Cookie', $cookie, false);
    }


    /**
     * Add no-cache headers
     *
     * @return $this
     */
    public function noCache()
    {
        $this->header('Cache-Control', 'no-cache, must-revalidate');
        $this->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');

        return $this;
    }


    /**
     * Response already sent ?
     *
     * @return bool
     */
    public function sent()
    {
        return headers_sent();
    }


    /**
     * Send response
     *
     * @return string
     */
    public function send()
    {
        // send headers
        if(!$this->sent()) {

            // set content type
            if(!isset($this->headers['Content-Type'])) {
                $header = 'Content-Type: ' . $this->format;
                if($this->charset) {
                    $header .= '; charset=' . $this->charset;
                }
                header($header);
            }

            // set http code
            header('HTTP/1.1 ' . $this->code . ' ' . Status::code($this->code), true, $this->code);

            // compile header
            foreach($this->headers as $name => $value) {
                if(is_array($value)) {
                    foreach($value as $subvalue) {
                        header($name . ': ' . $subvalue);
                    }
                }
                else {
                    header($name . ': ' . $value);
                }
            }
        }

        // send content
        echo (string)$this->content;

        return $this->sent();
    }

}