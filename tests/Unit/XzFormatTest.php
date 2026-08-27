<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\XzLzma\CompressionXzLzma;
use PHPUnit\Framework\TestCase;

class XzFormatTest extends TestCase
{
    public static function providerEncodingsData(): array
    {
        if (version_compare(PHP_VERSION, '8.5', '>=')) {
            return [];
        }
        $return = [
            'lzf' => [new CompressionXzLzma()],
        ];
        return $return;
    }

    /**
     * @dataProvider providerEncodingsData
     */
    public function testSizeAfterCompression($compressor)
    {
        if (version_compare(PHP_VERSION, '8.5', '>=')) {
            $this->markTestSkipped();
        }
        $text = file_get_contents(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'composer.lock');
        $c = $compressor->compress($text);
        $this->assertLessThan(strlen($text), strlen($c));
        $c = $compressor->decompress($c);
        $this->assertEquals($text, $c);
    }
}