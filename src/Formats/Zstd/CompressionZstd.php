<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Zstd;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionZstd implements CompressorInterface
{

    public function __construct()
    {
        if (!extension_loaded('zstd')) {
            throw new ExpectationFailedException("The extension ZSTD is not loaded");
        }
    }

    public function compress(string $text): string
    {
        return zstd_compress($text);
    }

    public function decompress(string $text): string
    {
        return zstd_uncompress($text);
    }
}