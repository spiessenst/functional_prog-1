<?php

class Sanitization
{


   public function StripSpaces( array $arr ): array
    {
        foreach ( $arr as $key => $value )
        {
            $arr[$key] = trim($value);
        }

        return $arr;
    }

    public  function ConvertSpecialChars( array $arr ): array
    {
        foreach ( $arr as $key => $value )
        {
            $arr[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        return $arr;
    }
}

