<?php

namespace Colorium\Http\Session;

interface Provider
{

    /**
     * Check if value exists in session
     *
     * @param string $key
     * @return bool
     */
    public function has($key);

    /**
     * Get value in session
     *
     * @param string $key
     * @param mixed $fallback
     * @return mixed
     */
    public function get($key, $fallback = null);

    /**
     * Set value in session
     *
     * @param string $key
     * @param mixed $value
     * @param bool $flash
     */
    public function set($key, $value, $flash = false);

    /**
     * Clear value in session
     *
     * @param string $key
     * @return bool
     */
    public function drop($key);

    /**
     * Get flash mesage in session
     *
     * @param string $key
     * @return string
     */
    public function flash($key);

    /**
     * Get user rank
     *
     * @return int
     */
    public function rank();

    /**
     * Get user object
     *
     * @return object
     */
    public function user();

    /**
     * Log user in session
     *
     * @param int $rank
     * @param object $user
     */
    public function login($rank = 0, $user = null);

    /**
     * Log user out of session
     */
    public function logout();

}