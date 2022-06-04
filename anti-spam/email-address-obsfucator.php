<?php
/**
 * Last found:
     https://dimentech.com/assets/obfuscator.html (04/06/22)

 License:
     This tool was originally conceived and written by Tim Williams of <a href="https://arizona.edu" target="_blank">The University of Arizona</a>.
     The code to randomly <br>generate a different encryption key each time the tool is used was written by Andrew Moulden of
     <!-- Domain no longer active: http://www.siteengineering.com/ --> Site Engineering Ltd.<br>

     Ross Killen of <a href="http://www.celticproductions.net/articles/10/email/php+email+obfuscator.html" target="_blank">Celtic
     Productions Ltd</a> has also created a <a href="obfuscator.txt">PHP version</a> to enable use of this technique in
     web applications.<br><br>

     <b>This code is distributed as freeware, provided the authors' credits etc remain exactly as shown.</b>

 Notes:
     The original snippet had some deprecated features & wasn't PSR friendly, so I've updated that!

 * */

function munge($address): string
{
    $address = strtolower($address);
    $coded = "";
    $unmixedKey = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.@";
    $inProgressKey = $unmixedKey;
    $mixedKey = "";
    $unshuffled = strlen($unmixedKey);

    for ($i = 0; $i <= strlen($unmixedKey); $i++) {
        $randomPosition = rand(0, $unshuffled - 1);
        $nextCharacter = $inProgressKey[$randomPosition];
        $mixedKey .= $nextCharacter;
        $before = substr($inProgressKey, 0, $randomPosition);
        $after = substr($inProgressKey, $randomPosition + 1, $unshuffled - ($randomPosition + 1));
        $inProgressKey = $before.''.$after;
        $unshuffled -= 1;
    }

    $cipher = $mixedKey;
    $shift = strlen($address);

    $txt = "<script type=\"text/javascript\">\n" .
        "<!-"."-\n" .
        "// Email obfuscator script 2.1 by Tim Williams, University of Arizona\n".
        "// Random encryption key feature by Andrew Moulden, Site Engineering Ltd\n".
        "// PHP version coded by Ross Killen, Celtic Productions Ltd\n".
        "// This code is freeware provided these six comment lines remain intact\n".
        "// A wizard to generate this code is at http://www.jottings.com/obfuscator/\n".
        "// The PHP code may be obtained from http://www.celticproductions.net/\n\n"
    ;

    for ($j = 0; $j < strlen($address); $j++) {
        if (strpos($cipher,$address[$j]) == -1) {
            $chr = $address[$j];
            $coded .= $address[$j];
        } else {
            $chr = (strpos($cipher,$address[$j]) + $shift) % strlen($cipher);
            $coded .= $cipher[$chr];
        }
    }

    $txt .= "\ncoded = \"" . $coded . "\"\n" .
        " key = \"".$cipher."\"\n".
        " shift=coded.length\n".
        " link=\"\"\n".
        " for (i = 0; i < coded.length; i++) {\n" .
        " if (key.indexOf(coded.charAt(i))==-1) {\n" .
        " ltr = coded.charAt(i)\n" .
        " link += (ltr)\n" .
        " }\n" .
        " else { \n".
        " ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length\n".
        " link += (key.charAt(ltr))\n".
        " }\n".
        " }\n".
        "document.write(\"<a href='mailto:\"+link+\"'>\"+link+\"</a>\")\n" .
        "\n".
        "//-"."->\n" .
        "<" . "/script><noscript>N/A" .
        "<"."/noscript>"
    ;

    return $txt;
}