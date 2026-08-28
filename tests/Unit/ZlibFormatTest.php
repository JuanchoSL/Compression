<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Zlib\CompressionHttpDeflate;
use JuanchoSL\Compression\Formats\Zlib\CompressionGzip;
use JuanchoSL\Compression\Formats\Zlib\CompressionRawDeflate;

class ZlibFormatTest extends AbstractStringCompression
{
    protected static function dataProvider(): array
    {
        return [
            'deflate' => [new CompressionHttpDeflate()],
            'gzip' => [new CompressionGzip()],
            'raw' => [new CompressionRawDeflate()],
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