<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Zstd\CompressionZstd;

class ZstdFormatTest extends AbstractStringCompression
{

    const PHP_MAX_VERSION = '8.5';

    const PHP_EXTENSION_REQUIRED = 'zstd';

    protected static function dataProvider(): array
    {
        return [
            'zstd' => [new CompressionZstd()],
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