<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Zlib;

use JuanchoSL\Compression\Contracts\CompressorInterface;

class CompressionRawDeflate extends AbstractZlibCompressor implements CompressorInterface
{
    protected function getEncoding(): int
    {
        return ZLIB_ENCODING_RAW;
    }

}