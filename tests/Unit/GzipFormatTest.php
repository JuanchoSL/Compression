<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Gzip\CompressionHttpDeflate;
use JuanchoSL\Compression\Formats\Gzip\CompressionGzip;

class GzipFormatTest extends AbstractStringCompression
{
    protected static function dataProvider(): array
    {
        return [
            'deflate' => [new CompressionHttpDeflate()],
            'gzip' => [new CompressionGzip()],
        ];
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

}