<?php

namespace App\Enums;

class GroupRole
{
    public const Admin = 1;
    public const User = 2;

    public static function getTitle($number)
    {
        return  match ($number) {
            self::Admin => 'ادمین',
            self::User => 'کاربر',

        };
    }

    public static function toArray()
    {
        return [
            ['id' => self::Admin, 'title' => 'ادمین'],
            ['id' => self::User, 'title' => 'کاربر'],
        ];
    }
}
