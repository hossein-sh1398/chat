<?php

namespace App\Enums;

class GroupType
{
    public const Group = 1;
    public const Channel = 2;


    public static function getTitle($number)
    {
        return  match ($number) {
            self::Group => 'گروه',
            self::Channel => 'کانال',

        };
    }

    public static function toArray()
    {
        return [
            ['id' => self::Group, 'title' => 'گروه'],
            ['id' => self::Channel, 'title' => 'کانال'],
        ];
    }
}
