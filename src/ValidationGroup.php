<?php

declare(strict_types=1);

namespace chaser\utils;

/**
 * 验证组类
 *
 * @package chaser\utils
 */
class ValidationGroup
{
    /**
     * 数字验证组
     *
     * @return bool[]
     */
    public static function digit()
    {
        return [
            '0' => true,
            '1' => true,
            '2' => true,
            '3' => true,
            '4' => true,
            '5' => true,
            '6' => true,
            '7' => true,
            '8' => true,
            '9' => true
        ];
    }
}
