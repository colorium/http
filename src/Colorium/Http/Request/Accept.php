<?php

namespace Colorium\Http\Request;

class Accept
{

    /** @var array */
    public $medias = [];

    /** @var array */
    public $languages = [];

    /** @var array */
    public $encodings = [];

    /** @var array */
    public $charsets = [];


    /**
     * Custom HTTP Accept
     *
     * @param array $medias
     * @param array $languages
     * @param array $encodings
     * @param array $charsets
     */
    public function __construct(array $medias = [], array $languages = [], array $encodings = [], array $charsets = [])
    {
        $this->medias = $medias;
        $this->language = $languages;
        $this->encoding = $encodings;
        $this->charset = $charsets;
    }


    /**
     * Negociate media
     *
     * @param string $compare
     * @return string
     */
    public function media($compare = null)
    {
        return $compare
            ? static::compare($compare, $this->medias)
            : reset($this->medias);
    }


    /**
     * Negociate language
     *
     * @param string $compare
     * @return string
     */
    public function language($compare = null)
    {
        return $compare
            ? static::compare($compare, $this->languages)
            : reset($this->languages);
    }


    /**
     * Negociate encoding
     *
     * @param string $compare
     * @return string
     */
    public function encoding($compare = null)
    {
        return $compare
            ? static::compare($compare, $this->encodings)
            : reset($this->encodings);
    }


    /**
     * Negociate charset
     *
     * @param string $compare
     * @return string
     */
    public function charset($compare = null)
    {
        return $compare
            ? static::compare($compare, $this->charsets)
            : reset($this->charsets);
    }


    /**
     * Parse from strings
     *
     * @param string $accept
     * @param string $acceptLanguage
     * @param string $acceptEncoding
     * @param string $acceptCharset
     *
     * @return static
     */
    public static function from($accept = null, $acceptLanguage = null, $acceptEncoding = null, $acceptCharset = null)
    {
        $medias = static::parse($accept, '/');
        $languages = static::parse($acceptLanguage, '-');
        $encodings = static::parse($acceptEncoding);
        $charsets = static::parse($acceptCharset);

        return new static($medias, $languages, $encodings, $charsets);
    }


    /**
     * Accept string parsing
     *
     * @param string $string
     * @param string $separator
     * @return array
     */
    protected static function parse($string, $separator = null)
    {
        $items = [];
        if($string) {
            $string = strtolower(str_replace(' ', '', $string));
            $rows = explode(',', $string);
            foreach($rows as $row) {
                @list($item, $quality) = explode(';q=', $row);
                if(!$quality) {
                    if($separator) {
                        @list($part, $subpart) = explode($separator, $item);
                        $quality = ($part = '*' or $subpart == '*') ? 0 : 1;
                    }
                    else {
                        $quality = ($item == '*') ? 0 : 1;
                    }
                }
                $items[$item] = (float)$quality;
            }
            sort($items);
            $items = array_keys($items);
        }

        return $items;
    }


    /**
     * Compare for negociation
     *
     * @param string $needle
     * @param array $haystack
     * @return bool
     */
    protected static function compare($needle, array $haystack)
    {
        foreach($haystack as $row) {
            if(fnmatch($row, $needle)) {
                return true;
            }
        }
        return false;
    }
    
}