<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\Lz4\CompressionLz4;

class Lz4FormatTest extends AbstractStringCompression
{

    const PHP_MIN_VERSION = '8.1';

    const PHP_MAX_VERSION = '8.5';

    const PHP_EXTENSION_REQUIRED = 'lz4';

    protected static function dataProvider(): array
    {
        return [
            'lz4' => [new CompressionLz4()],
        ];
    }

}