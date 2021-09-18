<?php

namespace JollyBlueMan\Console\Output;

class Message
{
    private static $pass = "16yw4633";
    private static $iv = "1234546wtr6666c4";
    private static $algo = "AES-256-CBC";
    private static $messages = [
        "greet.event.a" => "aF1DgdjPX6etxaNcqlovcCEzMRUaywJjgaFHDjabkRQ="
    ];

    public static function retrieve($message)
    {
        return self::decrypt(self::$messages[$message]);
    }

    private static function decrypt($message)
    {
        return openssl_decrypt($message, self::$algo, self::$pass, false, self::$iv);
    }
}