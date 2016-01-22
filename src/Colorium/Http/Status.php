<?php

namespace Colorium\Http;

abstract class Status
{

    // Info
    const _100 = 'Continue';
    const _101 = 'Switching Protocols';
    const _102 = 'Processing';            // RFC2518

    // Success
    const _200 = 'OK';
    const _201 = 'Created';
    const _202 = 'Accepted';
    const _203 = 'Non-Authoritative Information';
    const _204 = 'No Content';
    const _205 = 'Reset Content';
    const _206 = 'Partial Content';
    const _207 = 'Multi-Status';          // RFC4918
    const _208 = 'Already Reported';      // RFC5842
    const _226 = 'IM Used';               // RFC3229

    // Redirection
    const _300 = 'Multiple Choices';
    const _301 = 'Moved Permanently';
    const _302 = 'Found';
    const _303 = 'See Other';
    const _304 = 'Not Modified';
    const _305 = 'Use Proxy';
    const _306 = 'Reserved';
    const _307 = 'Temporary Redirect';
    const _308 = 'Permanent Redirect';    // RFC-reschke-http-status-308-07

    // Client error
    const _400 = 'Bad Request';
    const _401 = 'Unauthorized';
    const _402 = 'Payment Required';
    const _403 = 'Forbidden';
    const _404 = 'Not Found';
    const _405 = 'Method Not Allowed';
    const _406 = 'Not Acceptable';
    const _407 = 'Proxy Authentication Required';
    const _408 = 'Request Timeout';
    const _409 = 'Conflict';
    const _410 = 'Gone';
    const _411 = 'Length Required';
    const _412 = 'Precondition Failed';
    const _413 = 'Request Entity Too Large';
    const _414 = 'Request-URI Too Long';
    const _415 = 'Unsupported Media Type';
    const _416 = 'Requested Range Not Satisfiable';
    const _417 = 'Expectation Failed';
    const _418 = 'I\'m a teapot';                                               // RFC2324
    const _422 = 'Unprocessable Entity';                                        // RFC4918
    const _423 = 'Locked';                                                      // RFC4918
    const _424 = 'Failed Dependency';                                           // RFC4918
    const _425 = 'Reserved for WebDAV advanced collections expired proposal';   // RFC2817
    const _426 = 'Upgrade Required';                                            // RFC2817
    const _428 = 'Precondition Required';                                       // RFC6585
    const _429 = 'Too Many Requests';                                           // RFC6585
    const _431 = 'Request Header Fields Too Large';                             // RFC6585

    // Server error
    const _500 = 'Internal Server Error';
    const _501 = 'Not Implemented';
    const _502 = 'Bad Gateway';
    const _503 = 'Service Unavailable';
    const _504 = 'Gateway Timeout';
    const _505 = 'HTTP Version Not Supported';
    const _506 = 'Variant Also Negotiates (Experimental)';                      // RFC2295
    const _507 = 'Insufficient Storage';                                        // RFC4918
    const _508 = 'Loop Detected';                                               // RFC5842
    const _510 = 'Not Extended';                                                // RFC2774
    const _511 = 'Network Authentication Required';                             // RFC6585


    /**
     * Get code message
     *
     * @param $code
     * @return string
     */
    public static function message($code)
    {
        return constant(static::class . '::_' . $code);
    }

}