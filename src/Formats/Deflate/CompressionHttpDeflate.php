<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Deflate;

use JuanchoSL\Compression\Contracts\CompressorInterface;

class CompressionHttpDeflate extends AbstractDeflateCompressor implements CompressorInterface
{
    protected function getEncoding(): int
    {
        return ZLIB_ENCODING_DEFLATE;
    }

    public function decompress(string $text): string
    {
        return gzuncompress($text);
    }
}