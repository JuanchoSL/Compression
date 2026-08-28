<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\Snappy\CompressionSnappy;

class SnappyFormatTest extends AbstractStringCompression
{

    const PHP_MIN_VERSION = '8.1';

    const PHP_MAX_VERSION = '8.4';

    const PHP_EXTENSION_REQUIRED = 'snappy';


    protected static function dataProvider(): array
    {
        return [
            'snap' => [new CompressionSnappy()],
        ];
    }

}