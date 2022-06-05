<?php
/**
 * About this script
 -=-=-=--=-=-=-=-=-=--=

 Last found:
     https://dimentech.com/assets/obfuscator.html (04/06/22)

 Originally found:
    http://www.jottings.com/obfuscator/

 License:
     This tool was originally conceived and written by Tim Williams of <a href="https://arizona.edu" target="_blank">The University of Arizona</a>.
     The code to randomly <br>generate a different encryption key each time the tool is used was written by Andrew Moulden of
     <!-- Domain no longer active: http://www.siteengineering.com/ --> Site Engineering Ltd.<br>

     Ross Killen of <a href="http://www.celticproductions.net/articles/10/email/php+email+obfuscator.html" target="_blank">Celtic
     Productions Ltd</a> has also created a <a href="obfuscator.txt">PHP version</a> to enable use of this technique in
     web applications.<br><br>

     <b>This code is distributed as freeware, provided the authors' credits etc remain exactly as shown.</b>

 Notes:
     I've made some updates:
      - Updated deprecated php
      - Aimed for PSR friendliness
      - Swapped to heredoc for javascript
      - Tidied up javascript
 * */

echo munge('hello@jollyblueman.com');

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

    $txt = <<<EOD
    <script>
        // Email obfuscator script 2.1 by Tim Williams, University of Arizona
        // Random encryption key feature by Andrew Moulden, Site Engineering Ltd
        // PHP version coded by Ross Killen, Celtic Productions Ltd
        // This code is freeware provided these six comment lines remain intact
        // A wizard to generate this code is at http://www.jottings.com/obfuscator/
        // The PHP code may be obtained from http://www.celticproductions.net/
        
    EOD;

    for ($j = 0; $j < strlen($address); $j++) {
        if (strpos($cipher,$address[$j]) == -1) {
            $chr = $address[$j];
            $coded .= $address[$j];
        } else {
            $chr = (strpos($cipher,$address[$j]) + $shift) % strlen($cipher);
            $coded .= $cipher[$chr];
        }
    }

    $txt .= <<<EOD
         coded = "$coded";
         key = "$cipher";
         shift = coded.length;
         link = "";
         for (i = 0; i < coded.length; i++) {
            if (key.indexOf(coded.charAt(i)) == -1) {
                ltr = coded.charAt(i);
                link += (ltr);
            } else { 
                ltr = (key.indexOf(coded.charAt(i)) - shift + key.length) % key.length;
                link += (key.charAt(ltr));
            }
         }
        document.write("<a href='mailto:" + link + "'>" + link + "</a>");
    </script>
    <noscript>N/A</noscript>
    EOD;

    return $txt;
}
