<?php

namespace Colorium\Http;

class Uri
{

    /** @var string */
    public $scheme;

    /** @var string */
    public $user;

    /** @var string */
    public $password;

    /** @var string */
    public $host;

    /** @var int */
    public $port;

    /** @var string */
    public $base;

    /** @var string */
    public $path = '/';

    /** @var array */
    public $params = [];

    /** @var string */
    public $fragment;

    /** @var string */
    public $full;


    /**
     * Parse and init
     *
     * @param string $uri
     * @param string $base
     */
    public function __construct($uri = '/', $base = null)
    {
        if(!is_array($uri)) {
            $uri = parse_url($uri);
        }
        $parsed = $uri + [
            'scheme' => null,
            'user' => null,
            'pass' => null,
            'host' => null,
            'port' => null,
            'base' => $base,
            'path' => '/',
            'query' => null,
            'fragment' => null,
        ];

        $this->scheme = strtolower($parsed['scheme']);
        $this->user = $parsed['user'];
        $this->password = $parsed['pass'];
        $this->host = strtolower($parsed['host']);
        $this->port = (int)$parsed['port'];
        $this->base = $parsed['base'];
        $this->path = '/' . trim($parsed['path'], '/');
        $this->query = $parsed['query'];
        $this->fragment = $parsed['fragment'];

        if($this->base) {
            $this->path = substr($this->path, strlen($this->base)) ?: '/';
        }
        parse_str($parsed['query'], $this->params);

        $full = '/';
        if($this->host) {
            $authority = $this->host;
            if($this->port) {
                $authority .= ':' . $this->port;
            }
            if($this->user) {
                $userInfo = $this->user;
                if($this->password) {
                    $userInfo .= ':' . $this->password;
                }
                $authority = $userInfo . '@' . $authority;
            }
            $full = '//' . $authority . $full;
            if($this->scheme) {
                $full = $this->scheme . ':' . $full;
            }
        }
        if($this->base) {
            $full .= trim($this->base, '/') . '/';
        }
        if($this->path) {
            $full .= trim($this->path, '/');
        }
        if($this->query) {
            $full .= '?' . $this->query;
        }
        if($this->fragment) {
            $full .= '#' . $this->fragment;
        }
        $this->full = $full;
    }


    /**
     * Get uri param
     *
     * @param string $key
     * @return string
     */
    public function param($key)
    {
        return isset($this->params[$key])
            ? $this->params[$key]
            : null;
    }


    /**
     * Change base uri
     *
     * @param string $base
     * @return Uri
     */
    public function rebase($base)
    {
        return new static([
            'scheme' => $this->scheme,
            'user' => $this->user,
            'pass' => $this->password,
            'host' => $this->host,
            'port' => $this->port,
            'base' => $base,
            'path' => $this->path,
            'query' => $this->query,
            'fragment' => $this->fragment,
        ]);
    }


    /**
     * Make uri
     *
     * @param string $path
     * @param array $params
     * @return Uri
     */
    public function make($path, array $params = [])
    {
        return new static([
            'scheme' => $this->scheme,
            'user' => $this->user,
            'pass' => $this->password,
            'host' => $this->host,
            'port' => $this->port,
            'base' => $this->base,
            'path' => $this->base . $path,
            'query' => http_build_query($params),
            'fragment' => $this->fragment,
        ]);
    }


    /**
     * Compare query
     *
     * @param string $query
     *
     * @return bool
     */
    public function is($query)
    {
        return fnmatch($query, $this->path);
    }


    /**
     * Return full uri
     *
     * @return string
     */
    public function __toString()
    {
        return $this->full;
    }


    /**
     * Generate uri from $_SERVER
     *
     * @param bool|string $base
     * @return static
     */
    public static function current($base = true)
    {
        // parse server header
        $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : null;
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
        $path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
        $query = parse_url($path, PHP_URL_QUERY);
        $path = parse_url($path, PHP_URL_PATH);

        // auto-resolve base path
        if($base === true) {
            if(isset($_SERVER['SCRIPT_NAME']) and $script = dirname($_SERVER['SCRIPT_NAME'])) {
                while($script != '/') {
                    if(strncmp($path, $script, strlen($script)) === 0) {
                        $base = $script;
                        break;
                    }
                    $script = dirname($script);
                }
            }
        }

        return new static([
            'scheme' => $scheme,
            'user' => null,
            'pass' => null,
            'host' => $host,
            'port' => null,
            'base' => $base,
            'path' => $path,
            'query' => $query,
            'fragment' => null,
        ]);
    }


    /**
     * Sanitize string for uri usage
     *
     * @param $string
     * @return string
     */
    public static function sanitize($string)
    {
        $string = strtolower($string);
        $string = str_replace('é', 'e', $string);
        $string = str_replace('è', 'e', $string);
        $string = str_replace('ë', 'e', $string);
        $string = str_replace('ê', 'e', $string);
        $string = str_replace('à', 'a', $string);
        $string = str_replace('ä', 'a', $string);
        $string = str_replace('ö', 'o', $string);
        $string = str_replace('ù', 'u', $string);
        $string = str_replace('ü', 'u', $string);
        $string = str_replace('ç', 'c', $string);
        $string = preg_replace('/[^0-9a-z-]/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        $string = trim($string, ' -');

        return $string;
    }

}