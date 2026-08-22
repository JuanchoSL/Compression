<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Gzip;

use JuanchoSL\Compression\Contracts\CompressorInterface;

class CompressionGzip extends AbstractGzipCompressor implements CompressorInterface
{
    protected function getEncoding(): int
    {
        return FORCE_GZIP;
    }

}