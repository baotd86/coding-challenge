<?php

namespace App\Traits;

trait CustomValidation
{
    public function isSingleAssocArray($input): bool
    {
        if (!is_array($input)) return false;
        if (array() === $input) return false;
        foreach($input as $elm) {
            if(gettype($elm) != 'string') return false;
        }
        return array_keys($input) !== range(0, count($input) - 1);
    }
}
