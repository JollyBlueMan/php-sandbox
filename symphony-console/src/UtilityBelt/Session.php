<?php

namespace JollyBlueMan\Console\UtilityBelt;

class Session
{
    protected string $prefix = "console_";

    public function __construct($options = [])
    {
        session_start($options);
    }

    public function get($key, $default = null)
    {
        if (isset($_SESSION[$this->prefix.$key])) {
            return $_SESSION[$this->prefix.$key];
        }

        return $default;
    }

    public function set($key, $value)
    {
        $_SESSION[$this->prefix.$key] = $value;
    }

    public function erase($key)
    {
        unset($_SESSION[$this->prefix.$key]);
        return $this;
    }

    public function destroy()
    {
        session_destroy();
    }
}