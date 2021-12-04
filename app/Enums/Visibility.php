<?php

namespace App\Enums;

class Visibility
{
    const PUBLIC = 'public';
    const PROTECTED = 'protected';
    const PRIVATE = 'private';

    public static function getAllConstants()
    {
        $class = new \ReflectionClass(__CLASS__);
        return $class->getConstants();
    }
}
