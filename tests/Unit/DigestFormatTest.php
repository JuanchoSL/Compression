<?php

namespace JuanchoSL\Compression\Tests\Unit;

use JuanchoSL\Compression\Formats\Brotli\CompressionBrotli;
use JuanchoSL\Compression\Formats\Zstd\CompressionZstd;
use PHPUnit\Framework\TestCase;

class DigestFormatTest extends TestCase
{
    public static function providerEncodingsData(): array
    {
        $return = [
            'br'=> [(new CompressionBrotli())->setDictionary(implode(DIRECTORY_SEPARATOR, [ dirname(__FILE__,2),'data','dictionary-shorted.txt']))],
            'zstd'=> [(new CompressionZstd())->setDictionary(implode(DIRECTORY_SEPARATOR, [ dirname(__FILE__,2),'data','dictionary-shorted.txt']))],
        ];
        return $return;
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