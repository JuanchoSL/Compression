<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\XzLzma\CompressionXzLzma;

class XzFormatTest extends AbstractStringCompression
{

    const PHP_MAX_VERSION = '8.4';

    protected static function dataProvider(): array
    {
        return [
            'lzf' => [new CompressionXzLzma()],
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