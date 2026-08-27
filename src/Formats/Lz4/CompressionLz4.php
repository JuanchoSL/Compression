<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Lz4;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionLz4 implements CompressorInterface
{

    public function __construct()
    {
        if (!extension_loaded('lz4')) {
            throw new ExpectationFailedException("The extension LZ4 is not loaded");
        }
    }

    public function compress(string $text): string|false
    {
        return lz4_compress($text);
    }

    public function decompress(string $text): string|false
    {
        return lz4_uncompress($text);
    }
}