<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Zlib\CompressionHttpDeflate;
use JuanchoSL\Compression\Formats\Zlib\CompressionGzip;
use JuanchoSL\Compression\Formats\Zlib\CompressionRawDeflate;
use PHPUnit\Framework\TestCase;

class ZlibFormatTest extends TestCase
{
    public static function providerEncodingsData(): array
    {
        $return = [
            'deflate' => [new CompressionHttpDeflate()],
            'gzip' => [new CompressionGzip()],
            'raw' => [new CompressionRawDeflate()],
        ];
        return $return;
    }

    /**
     * @dataProvider providerEncodingsData
     */
    public function testLevelInvalid($compressor)
    {
        $class = get_class($compressor);
        $this->expectException(Exception::class);
        new $class(25);
    }

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