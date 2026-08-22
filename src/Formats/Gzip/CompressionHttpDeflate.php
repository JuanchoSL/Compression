<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Gzip;

use JuanchoSL\Compression\Contracts\CompressorInterface;

class CompressionHttpDeflate extends AbstractGzipCompressor implements CompressorInterface
{
    protected function getEncoding(): int
    {
        return FORCE_DEFLATE;
    }

    public function decompress(string $text): string|false
    {
        return gzuncompress($text);
    }
}