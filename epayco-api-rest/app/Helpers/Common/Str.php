<?php

namespace App\Helpers\Common;

class Str{
    public static function onlyText($text) : string
    {
        return self::removeUnnecessarySpaces(preg_replace('/[^a-zA-ZáéíóúÁÉÍÓÚñÑ \']/', ' ', $text));
    }

    public static function onlyNumbers($text)
    {
        return preg_replace('/[^0-9\.]/', '', str_replace(',', '.', $text));
    }

    public static function removeUnnecessarySpaces(string $text) : string
    {
        return trim(preg_replace('/\s+/', ' ', str_replace('&nbsp;', ' ', $text)));
    }

    public static function base64_url_encode(string $text): string
    {
        return str_replace('=', '', str_replace('/', '_', str_replace('+', '-', base64_encode($text))));
    }

    public static function customContains($word, $text)
    {
        $regexp = null;

        $text = strtolower($text);

        if(is_string($word))
        {
            $regexp = '/('.strtolower($word).')/';

            return preg_match($regexp, $text) === 1 ? true : false;
        }
        else
        {
            $found  = false;
            $length = count($word);

            for($i = 0; $i < $length; $i++)
            {
                $regexp = '/('.strtolower($word[$i]).')/';

                if(!$found && preg_match($regexp, $text) === 1)
                {
                    $found = true;

                    break;
                }
            }

            return $found;
        }
    }
}
