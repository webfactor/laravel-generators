<?php

namespace Webfactor\Laravel\Generators\Helper;

class ShortSyntaxArray
{
    public static function parse(array $expression, $removeNumericIndex = true, $indent = 4): string
    {
        $object = json_decode(str_replace(['(', ')'], ['&#40', '&#41'], json_encode($expression)), true);
        $export = str_replace(['array (', ')', '&#40', '&#41'], ['[', ']', '(', ')'], var_export($object, true));
        $export = preg_replace("/ => \n[^\S\n]*\[/m", ' => [', $export);
        $export = preg_replace("/ => \[\n[^\S\n]*\]/m", ' => []', $export);
        $spaces = str_repeat(' ', $indent);
        $export = preg_replace("/([ ]{2})(?![^ ])/m", $spaces, $export);
        $export = preg_replace("/^([ ]{2})/m", $spaces, $export);

        if ($removeNumericIndex) {
            $export = preg_replace("/([0-9]+) => /m", '', $export);
        }

        return $export;
    }
}
