<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\XzLzma\CompressionXzLzma;

class XzFormatTest extends AbstractStringCompression
{

    const PHP_MAX_VERSION = '8.4';

    const PHP_EXTENSION_REQUIRED = 'xz';

    protected static function dataProvider(): array
    {
        return [
            'xz' => [new CompressionXzLzma()],
        ];
    }

}