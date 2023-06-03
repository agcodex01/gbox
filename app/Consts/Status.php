<?php

namespace App\Consts;

class Status
{
    const PENDING = 'PENDING';
    const APPROVED = 'APPROVED';
    public static function options(): array
    {
        return [
            [
                'display' => 'pending',
                'key' => self::PENDING
            ],
            [
                'display' => 'approve',
                'key' => self::APPROVED
            ]
        ];
    }
}
