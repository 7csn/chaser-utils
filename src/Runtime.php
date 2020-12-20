<?php

declare(strict_types=1);

namespace chaser\utils;

use Generator;

/**
 * 运行时间类
 *
 * @package chaser
 */
class Runtime
{
    /**
     * 性能测试
     *
     * @param callable $process
     * @param int $times
     * @return float
     */
    public static function loop(callable $process, int $times = 100): float
    {
        $start = microtime();

        for ($i = 0; $i < $times; $i++) {
            $process();
        }

        return self::differ($start);
    }

    /**
     * 计算精确时间差
     *
     * @param string $start
     * @param string|null $end
     * @return float
     */
    public static function differ(string $start, ?string $end = null): float
    {
        if ($end === null) {
            $end = microtime();
        }
        $int = substr($end, -10) - substr($start, -10);
        $float = substr($end, 0, 8) - substr($start, 0, 8);
        return round($int + $float, 6);
    }

    /**
     * 生成器
     *
     * @param int $times
     * @return Generator
     */
    public static function generator(int $times = 100): Generator
    {
        for ($i = 0; $i < $times; $i++) {
            yield $i;
        }
    }

    /**
     * 获取当前精确日期时间
     *
     * @param string $format
     * @param int $precision 1~6
     * @return string
     */
    public static function datetime(string $format = 'Y-m-d H:i:s', int $precision = 6): string
    {
        [$float, $int] = self::times();
        return date($format, (int)$int) . substr($float, 1, $precision + 1);
    }

    /**
     * 获取当前精确日期时间（纯数字）
     *
     * @param string $format
     * @param int $precision 1~6
     * @return string
     */
    public static function datetimeNumber(string $format = 'YmdHis', int $precision = 6): string
    {
        [$float, $int] = self::times();
        return date($format, (int)$int) . substr($float, 2, $precision);
    }

    /**
     * 获取当前精确时间
     *
     * @param int $precision 1~6
     * @return string
     */
    public static function time(int $precision = 6): string
    {
        [$float, $int] = self::times();
        return $int . substr($float, 1, $precision);
    }

    /**
     * 获取当前精确时间数组
     *
     * @return array
     */
    public static function times(): array
    {
        return explode(' ', microtime());
    }
}
