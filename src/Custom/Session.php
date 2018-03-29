<?php

namespace Application\Custom;

class Session
{
    public static function has($key)
    { 
        return array_key_exists($key, $_SESSION); 
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value; 
    }

    public static function get($key, $default = false)
    {
        return (self::has($key)) ? $_SESSION[$key] : $default; 
    }

    public static function delete($key)
    {
       if (isset($_SESSION)) {
            unset($_SESSION[$key]);
       }
    }

    public static function destroy()
    {
       session_destroy();
    }

    public static function get_once($key, $default=false)
    {
        $value = self::get($key, $default);
        self::delete($key);
        
        return $value;   
    }

    public static function dump()
    {
        if (!isset($_SESSION)) {
            throw new \Exception("Session is not initialized");
        }

        print_r($_SESSION);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}