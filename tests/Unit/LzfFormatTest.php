<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\Lzf\CompressionLzf;
use PHPUnit\Framework\TestCase;

class LzfFormatTest extends TestCase
{
    public static function providerEncodingsData(): array
    {
        if (version_compare(PHP_VERSION, '8.6', '>=')) {
            return [];
        }
        $return = [
            'lzf' => [new CompressionLzf()],
        ];
        return $return;
    }

    /**
     * @dataProvider providerEncodingsData
     */
    public function testSizeAfterCompression($compressor)
    {
        if (version_compare(PHP_VERSION, '8.6', '>=')) {
            $this->markTestSkipped();
        }
        $text = file_get_contents(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'composer.lock');
        $c = $compressor->compress($text);
        $this->assertLessThan(strlen($text), strlen($c));
        $c = $compressor->decompress($c);
        $this->assertEquals($text, $c);
    }
}