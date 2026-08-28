<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Brotli\CompressionBrotli;
use JuanchoSL\Compression\Formats\Zstd\CompressionZstd;

class DigestFormatTest extends AbstractStringCompression
{

    const PHP_MAX_VERSION = '8.5';

    const PHP_EXTENSION_REQUIRED = 'br';

    protected static function dataProvider(): array
    {
        return [
            'br' => [(new CompressionBrotli())->setDictionary(implode(DIRECTORY_SEPARATOR, [dirname(__FILE__, 2), 'data', 'dictionary-shorted.txt']))],
            'zstd' => [(new CompressionZstd())->setDictionary(implode(DIRECTORY_SEPARATOR, [dirname(__FILE__, 2), 'data', 'dictionary-shorted.txt']))],
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