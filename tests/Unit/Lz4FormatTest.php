<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\Lz4\CompressionLz4;

class Lz4FormatTest extends AbstractStringCompression
{

    const PHP_MIN_VERSION = '8.1';

    const PHP_MAX_VERSION = '8.5';

    protected static function dataProvider(): array
    {
        return [
            'lz4' => [new CompressionLz4()],
        ];
    }

    /**
     * @dataProvider providerEncodingsData
     */
    public function testSizeAfterCompression($compressor)
    {
        $text = file_get_contents(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'composer.lock');
        $c = $compressor->compress($text);
        $this->assertLessThan(strlen($text), strlen($c));
        $c = $compressor->decompress($c);
        $this->assertEquals($text, $c);
    }
}