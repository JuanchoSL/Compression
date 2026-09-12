<?php

namespace JuanchoSL\Compression\Tests\Functional;

use JuanchoSL\Compression\FileHandlers\Brotli\BrotliFileReader;
use JuanchoSL\Compression\FileHandlers\Brotli\BrotliFileWriter;
use JuanchoSL\Compression\FileHandlers\Bzip2\Bzip2FileReader;
use JuanchoSL\Compression\FileHandlers\Bzip2\Bzip2FileWriter;
use JuanchoSL\Compression\FileHandlers\Lz4\Lz4FileReader;
use JuanchoSL\Compression\FileHandlers\Lz4\Lz4FileWriter;
use JuanchoSL\Compression\FileHandlers\Lzf\LzfFileReader;
use JuanchoSL\Compression\FileHandlers\Lzf\LzfFileWriter;
use JuanchoSL\Compression\FileHandlers\XzLzma\XzLzmaFileReader;
use JuanchoSL\Compression\FileHandlers\XzLzma\XzLzmaFileWriter;
use JuanchoSL\Compression\FileHandlers\Zlib\ZlibFileReader;
use JuanchoSL\Compression\FileHandlers\Zlib\ZlibFileWriter;
use JuanchoSL\Compression\FileHandlers\Zstd\ZstdFileReader;
use JuanchoSL\Compression\FileHandlers\Zstd\ZstdFileWriter;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
{
    public static function providerHandlers(): array
    {
        $return = [
            'bzip' => [Bzip2FileWriter::class, Bzip2FileReader::class],
            'zlib' => [ZlibFileWriter::class, ZlibFileReader::class],
        ];
        if (version_compare(PHP_VERSION, '8.6', '<')) {
            $return += [
                'lzf' => [LzfFileWriter::class, LzfFileReader::class],
                'br' => [BrotliFileWriter::class, BrotliFileReader::class],
                'zstd' => [ZstdFileWriter::class, ZstdFileReader::class],
                'lz4' => [Lz4FileWriter::class, Lz4FileReader::class],
                'xz' => [XzLzmaFileWriter::class, XzLzmaFileReader::class],
            ];
            if (version_compare(PHP_VERSION, '8.5', '<')) {
                $return += [
                ];
            }
        }
        return $return;
    }

    /**
     * @dataProvider providerHandlers
     */
    public function testSizeAfterCompression($handler, $reader)
    {
        $file = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'composer.lock';
        $compressed = $handler::compress($file);
        $this->assertLessThan(filesize($file), filesize($compressed));
        $reader = new $reader($compressed);
        $this->assertEquals(file_get_contents($file), (string) $reader);
        unlink($compressed);
    }
}