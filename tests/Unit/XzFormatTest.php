<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\XzLzma\CompressionXzLzma;

class XzFormatTest extends AbstractStringCompression
{

    const PHP_MAX_VERSION = '8.5';

    const PHP_EXTENSION_REQUIRED = 'xz';

    protected static function dataProvider(): array
    {
        return [
            'xz' => [new CompressionXzLzma()],
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