<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Brotli\CompressionBrotli;
use PHPUnit\Framework\TestCase;

abstract class AbstractStringCompression extends TestCase
{

    const PHP_MIN_VERSION = '8.0';
    const PHP_MAX_VERSION = '8.6';
    const PHP_EXTENSION_REQUIRED = '';

    public static function providerEncodingsData(): array
    {
        if (
            version_compare(PHP_VERSION, static::PHP_MIN_VERSION, '<') or
            version_compare(PHP_VERSION, static::PHP_MAX_VERSION, '>') or
            (!empty(static::PHP_EXTENSION_REQUIRED) and !extension_loaded(static::PHP_EXTENSION_REQUIRED))
        ) {
            return [];
        }
        return static::dataProvider();
    }

    abstract protected static function dataProvider(): array;

    /**
     * @dataProvider providerEncodingsData
     */
    public function testSizeAfterCompression($compressor)
    {
        $text = file_get_contents(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'composer.lock');
        $c = $compressor->compress($text);
        $this->assertLessThan(strlen($text), strlen($c));
        $c = $compressor->decompress($c);
        $this->assertEquals($text, $c);
    }
}