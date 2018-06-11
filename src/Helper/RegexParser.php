<?php

namespace Webfactor\Laravel\Generators\Helper;

class RegexParser
{
    public static function getLeftFromParenthesis($string)
    {
        $firstPart = explode('(', $string);

        return $firstPart[0];
    }

    public static function getContentOfParenthesis($string)
    {
        $pattern = '/\(([^\(\)]*)\)/m';

        preg_match_all($pattern, $string, $matches);

        return $matches[1][0] ?? '';
    }
}
