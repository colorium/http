<?php

namespace Colorium\Http;

abstract class Status
{

    protected static $_100 = 'Continue';
    protected static $_101 = 'Switching Protocols';
    protected static $_102 = 'Processing';            // RFC2518

    protected static $_200 = 'OK';
    protected static $_201 = 'Created';
    protected static $_202 = 'Accepted';
    protected static $_203 = 'Non-Authoritative Information';
    protected static $_204 = 'No Content';
    protected static $_205 = 'Reset Content';
    protected static $_206 = 'Partial Content';
    protected static $_207 = 'Multi-Status';          // RFC4918
    protected static $_208 = 'Already Reported';      // RFC5842
    protected static $_226 = 'IM Used';               // RFC3229

    protected static $_300 = 'Multiple Choices';
    protected static $_301 = 'Moved Permanently';
    protected static $_302 = 'Found';
    protected static $_303 = 'See Other';
    protected static $_304 = 'Not Modified';
    protected static $_305 = 'Use Proxy';
    protected static $_306 = 'Reserved';
    protected static $_307 = 'Temporary Redirect';
    protected static $_308 = 'Permanent Redirect';    // RFC-reschke-http-status-308-07

    protected static $_400 = 'Bad Request';
    protected static $_401 = 'Unauthorized';
    protected static $_402 = 'Payment Required';
    protected static $_403 = 'Forbidden';
    protected static $_404 = 'Not Found';
    protected static $_405 = 'Method Not Allowed';
    protected static $_406 = 'Not Acceptable';
    protected static $_407 = 'Proxy Authentication Required';
    protected static $_408 = 'Request Timeout';
    protected static $_409 = 'Conflict';
    protected static $_410 = 'Gone';
    protected static $_411 = 'Length Required';
    protected static $_412 = 'Precondition Failed';
    protected static $_413 = 'Request Entity Too Large';
    protected static $_414 = 'Request-URI Too Long';
    protected static $_415 = 'Unsupported Media Type';
    protected static $_416 = 'Requested Range Not Satisfiable';
    protected static $_417 = 'Expectation Failed';
    protected static $_418 = 'I\'m a teapot';                                               // RFC2324
    protected static $_422 = 'Unprocessable Entity';                                        // RFC4918
    protected static $_423 = 'Locked';                                                      // RFC4918
    protected static $_424 = 'Failed Dependency';                                           // RFC4918
    protected static $_425 = 'Reserved for WebDAV advanced collections expired proposal';   // RFC2817
    protected static $_426 = 'Upgrade Required';                                            // RFC2817
    protected static $_428 = 'Precondition Required';                                       // RFC6585
    protected static $_429 = 'Too Many Requests';                                           // RFC6585
    protected static $_431 = 'Request Header Fields Too Large';                             // RFC6585

    protected static $_500 = 'Internal Server Error';
    protected static $_501 = 'Not Implemented';
    protected static $_502 = 'Bad Gateway';
    protected static $_503 = 'Service Unavailable';
    protected static $_504 = 'Gateway Timeout';
    protected static $_505 = 'HTTP Version Not Supported';
    protected static $_506 = 'Variant Also Negotiates (Experimental)';                      // RFC2295
    protected static $_507 = 'Insufficient Storage';                                        // RFC4918
    protected static $_508 = 'Loop Detected';                                               // RFC5842
    protected static $_510 = 'Not Extended';                                                // RFC2774
    protected static $_511 = 'Network Authentication Required';                             // RFC6585


    /**
     * Get code message
     *
     * @param $code
     * @return string
     */
    public static function code($code)
    {
        $code = '_' . $code;
        return isset(static::$$code) ? static::$$code : null;
    }

}