<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Deflate;

use JuanchoSL\Compression\Contracts\CompressorInterface;

class CompressionRawDeflate extends AbstractDeflateCompressor implements CompressorInterface
{
    protected function getEncoding(): int
    {
        return ZLIB_ENCODING_RAW;
    }

}