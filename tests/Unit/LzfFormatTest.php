<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\Lzf\CompressionLzf;

class LzfFormatTest extends AbstractStringCompression
{

    const PHP_MAX_VERSION = '8.5';

    const PHP_EXTENSION_REQUIRED = 'lzf';

    protected static function dataProvider(): array
    {
        return [
            'lzf' => [new CompressionLzf()],
        ];
    }

}