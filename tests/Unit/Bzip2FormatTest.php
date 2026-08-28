<?php

namespace JuanchoSL\Compression\Tests\Unit;

use Exception;
use JuanchoSL\Compression\Formats\Bzip2\CompressionBzip2;

class Bzip2FormatTest extends AbstractStringCompression
{

    const PHP_EXTENSION_REQUIRED = 'bz2';

    protected static function dataProvider(): array
    {
        return [
            'bzip' => [new CompressionBzip2()],
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