<?php

namespace Webfactor\Laravel\Generators\Helper;

class RegexParser
{
    public static function parseParenthesis(string $string): array
    {
        preg_match('/^(.*)\((.*)\)/', $string, $match);

        return [
            'left' => $match[1],
            'inside' => $match[2],
        ];
    }
}
