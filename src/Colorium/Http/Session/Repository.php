<?php

namespace Colorium\Http\Session;

class Repository implements Provider
{

    /**
     * Setup repository session config
     */
    public function __construct()
    {
        if(!session_id() and !headers_sent()) {
            ini_set('session.use_trans_sid', 0);
            ini_set('session.use_only_cookies', 1);
            ini_set("session.cookie_lifetime", 604800);
            ini_set("session.gc_maxlifetime", 604800);
            session_set_cookie_params(604800);
            session_start();
        }

        if(!isset($_SESSION['__DATA__'])) {
            $_SESSION['__DATA__'] = [];
        }
        if(!isset($_SESSION['__FLASH__'])) {
            $_SESSION['__FLASH__'] = [];
        }
        if(!isset($_SESSION['__AUTH__'])) {
            $_SESSION['__AUTH__'] = [];
        }
    }


    /**
     * Check if value exists in session
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return arraydot_has($_SESSION['__DATA__'], $key);
    }


    /**
     * Get value in session
     *
     * @param string $key
     * @param mixed $fallback
     * @return mixed
     */
    public function get($key, $fallback = null)
    {
        return arraydot_get($_SESSION['__DATA__'], $key, $fallback);
    }


    /**
     * Set value in session
     *
     * @param string $key
     * @param mixed $value
     * @param bool $flash
     */
    public function set($key, $value, $flash = false)
    {
        $index = $flash ? '__FLASH__' : '__DATA__';
        arraydot_set($_SESSION[$index], $key, $value);
    }


    /**
     * Clear value in session
     *
     * @param string $key
     * @return bool
     */
    public function drop($key)
    {
        return arraydot_drop($_SESSION['__DATA__'], $key);
    }


    /**
     * Get flash mesage in session
     *
     * @param string $key
     * @return string
     */
    public function flash($key)
    {
        $message = arraydot_get($_SESSION['__FLASH__'], $key);
        arraydot_drop($_SESSION['__FLASH__'], $key);
        return $message;
    }


    /**
     * Get user rank
     *
     * @return int
     */
    public function rank()
    {
        return arraydot_get($_SESSION['__AUTH__'], 'rank', 0);
    }


    /**
     * Get user object
     *
     * @return object
     */
    public function user()
    {
        return arraydot_get($_SESSION['__AUTH__'], 'user', 0);
    }


    /**
     * Log user in session
     *
     * @param int $rank
     * @param object $user
     */
    public function login($rank = 0, $user = null)
    {
        arraydot_set($_SESSION['__AUTH__'], 'rank', $rank);
        arraydot_set($_SESSION['__AUTH__'], 'user', serialize($user));
    }


    /**
     * Log user out of session
     */
    public function logout()
    {
        arraydot_set($_SESSION['__AUTH__'], 'rank', 0);
        arraydot_set($_SESSION['__AUTH__'], 'user', serialize(null));
    }

}