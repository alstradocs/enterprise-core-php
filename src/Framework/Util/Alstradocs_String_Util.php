<?php

namespace Enterprise\Framework\Util;

class Alstradocs_String_Util {

    public static $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function generateString( $strength = 16) {
        $input_length = strlen(Alstradocs_String_Util::$permitted_chars);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = Alstradocs_String_Util::$permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

}
