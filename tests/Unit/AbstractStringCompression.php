<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Brotli\CompressionBrotli;
use PHPUnit\Framework\TestCase;

abstract class AbstractStringCompression extends TestCase
{

    const PHP_MIN_VERSION = '8.0';
    const PHP_MAX_VERSION = '8.6';

    public static function providerEncodingsData(): array
    {
        if (version_compare(PHP_VERSION, static::PHP_MIN_VERSION, '<') or version_compare(PHP_VERSION, static::PHP_MAX_VERSION, '>')) {
            return [];
        }
        return static::dataProvider();
    }

    abstract protected static function dataProvider(): array;
}