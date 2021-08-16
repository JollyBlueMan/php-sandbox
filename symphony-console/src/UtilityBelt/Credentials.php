<?php

namespace JollyBlueMan\Console\UtilityBelt;

class Credentials
{
    public static function validateLogin($username, $password): bool
    {
        $info = self::getBasicLoginCredentials();
        if ($password == (ord(json_decode(file_get_contents(__DIR__."{$info['0']}{$info['1']}{$info[2]}{$info[3]}"), true)[$info[4]]) * ord($username))) {
            return true;
        }

        return false;
    }

    private static function decipher($input): string
    {
        $output = "";
        foreach ($input as $item) {
            $output .= strtolower(chr($item + 64));
        }

        return $output;
    }

    private static function getBasicLoginCredentials(): array
    {
        return [
            "/../../",
            self::decipher([3,15,13,16,15,19,5,18]),
            ".",
            self::decipher([10,19,15,14]),
            self::decipher([14,1,13,5])
        ];
    }

}