<?php

declare(strict_types=1);

namespace chaser\utils;

/**
 * 验证器类
 *
 * @package chaser\utils
 */
class Validator
{
    /**
     * 自然数
     *
     * @param string $number
     * @return bool
     */
    public static function naturalNumber(string $number): bool
    {
        return $number === '0' ? false : self::id($number);
    }

    /**
     * 正整数
     *
     * @param string $number
     * @return bool
     */
    public static function id(string $number): bool
    {
        if (empty($number[0])) {
            return false;
        }

        if (!is_numeric($number)) {
            return false;
        }

        if (strpos($number, '.') !== false) {
            return false;
        }

        return true;
    }

    /**
     * 身份证号
     *
     * @param string $number
     * @return bool
     */
    public static function idCard(string $number): bool
    {
        if (strlen($number) !== 18) {
            return false;
        }

        $end = substr($number, -1);

        $digits = ValidationGroup::digit();

        if ($end !== 'X' && !isset($digits[$end])) {
            return false;
        }

        $weight = 0;

        // 权值
        $W = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];

        for ($i = 0; $i < 17; $i++) {

            $n = $number[$i];

            if (!isset($digits[$n])) {
                return false;
            }

            $weight += (int)$n * $W[$i];
        }

        // 校验码
        $Y = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];

        return $Y[$weight % 11] === $end;
    }

    /**
     * 银行卡号
     *
     * @param string $number
     * @return bool
     */
    public static function bankCard(string $number): bool
    {
        $oddSum = $evenSum = 0;

        $isOdd = true;

        $digits = ValidationGroup::digit();

        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $n = $number[$i];

            if (!isset($digits[$n])) {
                return false;
            }

            if ($isOdd) {
                $oddSum += (int)$n;
            } else {
                $even = (int)$n * 2;
                $even > 9 && $even -= 9;
                $evenSum += $even;
            }

            $isOdd = !$isOdd;
        }

        return ($oddSum + $evenSum) % 10 === 0;
    }
}
