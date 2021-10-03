<?php

namespace JollyBlueMan\Console\Output;

class Message
{
    private static string $pass = "16yw4633";
    private static string $iv = "1234546wtr6666c4";
    private static string $algo = "AES-256-CBC";
    private static array $messages = [
        "greet.event.a" => "K9mWdmD8PkW+i/eMTjVCySK76LtyoBGPjEnTtx824Es=",
        "greet.event.b" => "CiHEnM134W9dWFinGzNFi07nyTDl/mho1WR0qWLowWxhCLqcOE1VtySrrLSHLAr7bSVmqTa03kpL46Z6L8iYSi1PQFpIjs3V/FhkiaQVx/gKkiewlUAoAHZd2R2CyWjmKt8aEc53ztQ32hrBY0F3Lw==",
        "greet.event.c" => "GgzZrlf06xhLyD+dQ/pVrOh0VB2fBDMdYc8QdpSkiRMBaOMrCEn2b2eN63rua/lOcwuOK+Vfoi9Lky1fbLtHvQ=="
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