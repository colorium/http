<?php

namespace Colorium\Http;

class Request
{

    /** @var Uri */
    public $uri;

    /** @var int */
    public $code = 200;

    /** @var string */
    public $method;

    /** @var bool http or https */
    public $secure;

    /** @var string */
    public $body;

    /** @var bool */
    public $ajax;

    /** @var Request\Accept */
    public $accept;

    /** @var string */
    public $root;

    /** @var array */
    public $headers = [];

    /** @var array */
    public $servers = [];

    /** @var array */
    public $envs = [];

    /** @var array */
    public $values = [];

    /** @var array */
    public $cookies = [];

    /** @var Request\File[] */
    public $files = [];

    /** @var bool */
    public $cli = false;

    /** @var string */
    public $agent;

    /** @var string */
    public $ip;

    /** @var array */
    public $local = ['127.0.0.1', '::1'];

    /** @var string */
    public $time;


    /**
     * New http request
     *
     * @param string|Uri $uri
     * @param string $method
     */
    public function __construct($uri = '/', $method = 'GET')
    {
        $this->uri = ($uri instanceof Uri) ? $uri : new Uri($uri);
        $this->method = $method;

        $this->accept = new Request\Accept;

        $this->cli = (php_sapi_name() == 'cli');
    }


    /**
     * Get header
     *
     * @param string $name
     *
     * @return string
     */
    public function header($name)
    {
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }


    /**
     * Get _server
     *
     * @param string $name
     *
     * @return string
     */
    public function server($name)
    {
        return isset($this->servers[$name]) ? $this->servers[$name] : null;
    }


    /**
     * Get _env
     *
     * @param string $name
     *
     * @return string
     */
    public function env($name)
    {
        return isset($this->envs[$name]) ? $this->envs[$name] : null;
    }


    /**
     * Get _post
     *
     * @param string $name
     *
     * @return string
     */
    public function value($name)
    {
        return isset($this->values[$name]) ? $this->values[$name] : null;
    }


    /**
     * Get _file
     *
     * @param string $name
     *
     * @return Request\File
     */
    public function file($name)
    {
        return isset($this->files[$name]) ? $this->files[$name] : null;
    }


    /**
     * Get _cookie
     *
     * @param string $name
     *
     * @return string
     */
    public function cookie($name)
    {
        return isset($this->cookies[$name]) ? $this->cookies[$name] : null;
    }


    /**
     * If IP is local
     *
     * @return bool
     */
    public function local()
    {
        return in_array($this->ip, $this->local);
    }


    /**
     * Create from global environment
     *
     * @param bool|string $base
     * @return static
     */
    public static function current($base = true)
    {
        $uri = Uri::current($base);

        $request = new static($uri);
        $request->servers = &$_SERVER;
        $request->envs = &$_ENV;
        $request->values = &$_POST;
        $request->cookies = &$_COOKIE;

        $request->accept = Request\Accept::from(
            $request->server('HTTP_ACCEPT'),
            $request->server('HTTP_ACCEPT_LANGUAGE'),
            $request->server('HTTP_ACCEPT_ENCODING'),
            $request->server('HTTP_ACCEPT_CHARSET')
        );
        $request->method = $request->server('REQUEST_METHOD');
        $request->secure = ($request->server('HTTPS') == 'on');
        $request->ajax = $request->server('HTTP_X_REQUESTED_WITH')
            && strtolower($request->server('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest';

        $request->root = dirname($request->server('SCRIPT_FILENAME'));
        $request->root = rtrim($request->root, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        if(function_exists('http_response_code')) {
            $request->code = http_response_code();
        }
        if(function_exists('http_get_request_body')) {
            $request->body = http_get_request_body();
        }
        if(function_exists('apache_request_headers')) {
            $request->headers = apache_request_headers();
        }

        foreach($_FILES as $index => $file) {
            $request->files[$index] = new Request\File($file);
        }

        $request->agent = $request->server('HTTP_USER_AGENT');
        $request->ip = $request->server('REMOTE_ADDR');
        $request->time = $request->server('REQUEST_TIME');

        return $request;
    }

}