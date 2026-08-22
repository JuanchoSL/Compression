<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Deflate;

use JuanchoSL\Compression\Contracts\CompressorInterface;

class CompressionGzip extends AbstractDeflateCompressor implements CompressorInterface
{
    protected function getEncoding(): int
    {
        return ZLIB_ENCODING_GZIP;
    }
    
    public function decompress(string $text): string
    {
        return gzdecode($text);
    }
}