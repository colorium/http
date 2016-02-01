<?php

namespace Colorium\Http\Response;

use Colorium\Http\Response;

class Download extends Response
{

    /** @var string */
    public $filename;


    /**
     * New Redirect Response
     *
     * @param string $filename
     * @param int $code
     * @param array $headers
     */
    public function __construct($filename, $code = 302, array $headers = [])
    {
        parent::__construct(null, $code, $headers);

        $this->filename = $filename;
        $this->header('Content-Type', 'application/octet-stream');
        $this->header('Content-Length', filesize($filename));
        $this->header('Content-Disposition', 'attachment; filename=\"' . basename($filename) . '\"');
        $this->noCache();
    }


    /**
     * Send response
     *
     * @return string
     */
    public function send()
    {
        $this->content = file_get_contents($this->filename);
        parent::send();
        exit;
    }

}