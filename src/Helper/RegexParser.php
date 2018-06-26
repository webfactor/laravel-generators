<?php

namespace Webfactor\Laravel\Generators\Helper;

class RegexParser
{
    /**
     * Parses a string and returns the string left from and inside the parenthesis: left(inside)
     *
     * @param string $string
     * @return array
     */
    public static function parseParenthesis(string $string): array
    {
        if (str_contains($string, '(') && str_contains($string, ')')) {
            preg_match('/(.*)(\((.*)\))/', $string, $match);
        }

        return [
            'left' => $match[1] ?? $string,
            'inside' => $match[3] ?? '',
        ];
    }
}
