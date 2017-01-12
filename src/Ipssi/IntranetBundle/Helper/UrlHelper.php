<?php

namespace Ipssi\IntranetBundle\Helper;



class UrlHelper
{
    public static function stringToKebab($string)
    {

        // replace non letter or digits by -
        $kebabString = preg_replace('~[^\pL\d]+~u', '-', $string);

        // transliterate
        $kebabString = iconv('utf-8', 'us-ascii//TRANSLIT', $kebabString);

        // remove unwanted characters
        $kebabString = preg_replace('~[^-\w]+~', '', $kebabString);

        // trim
        $kebabString = trim($kebabString, '-');

        // remove duplicate -
        $kebabString = preg_replace('~-+~', '-', $kebabString);

        // lowercase
        $kebabString = strtolower($kebabString);

        if (empty($string)) {
            return 'n-a';
        }


        return $kebabString;
    }
}