<?php

namespace Colorium\Http;

abstract class Session
{

	/** @var Session\Provider */
	protected static $provider;


	/**
	 * Load session provider
	 *
	 * @param Session\Provider $provider
	 * @return Session\Provider
	 */
	public static function provider(Session\Provider $provider = null)
	{
		if($provider) {
			static::$provider = $provider;
		}
		elseif(!static::$provider) {
			static::$provider = new Session\Native;
		}

		return static::$provider;
	}


	/**
	 * Check if value exists in session
	 * 
	 * @param string $key 
	 * 
	 * @return bool
	 */
	public static function has($key)
	{
		return static::provider()->has($key);
	}


	/**
	 * Get value in session
	 * 
	 * @param string $key 
	 * @param mixed $fallback 
	 * 
	 * @return mixed
	 */
	public static function get($key, $fallback = null)
	{
		return static::provider()->get($key, $fallback);
	}


	/**
	 * Set value in session
	 * 
	 * @param string $key 
	 * @param mixed $value 
	 * @param bool $flash
	 */
	public static function set($key, $value, $flash = false)
	{
		static::provider()->set($key, $value, $flash);
	}


	/**
	 * Clear value in session
	 *
	 * @param string $key 
	 * @return bool
	 */
	public static function drop($key)
	{
		return static::provider()->drop($key);
	}


	/**
	 * Get flash message in session
	 *
	 * @param string $key 
	 * @return string
	 */
	public static function flash($key)
	{
		return static::provider()->flash($key);
	}


	/**
	 * Get user rank
	 *
	 * @return int
	 */
	public static function rank()
	{
		return static::provider()->rank();
	}


	/**
	 * Get user object
	 *
	 * @return object
	 */
	public static function user()
	{
		return static::provider()->user();
	}


	/**
	 * Log user in session
	 *
	 * @param int $rank 
	 * @param object $user 
	 */
	public static function login($rank = 0, $user = null)
	{
		static::provider()->login($rank, $user);
	}


	/**
	 * Log user out of session
	 */
	public static function logout()
	{
		static::provider()->logout();
	}

}