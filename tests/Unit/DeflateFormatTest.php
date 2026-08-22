<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\Deflate\CompressionHttpDeflate;
use JuanchoSL\Compression\Formats\Deflate\CompressionGzip;
use JuanchoSL\Compression\Formats\Deflate\CompressionRawDeflate;
use PHPUnit\Framework\TestCase;

class DeflateFormatTest extends TestCase
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
    public function testSizeAfterCompression($compressor)
    {
        $text = file_get_contents(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'composer.lock');
        $c = $compressor->compress($text);
        $this->assertLessThan(strlen($text), strlen($c));
        $c = $compressor->decompress($c);
        $this->assertEquals($text, $c);
    }
}