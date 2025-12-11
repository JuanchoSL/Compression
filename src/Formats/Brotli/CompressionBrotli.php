<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Brotli;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionBrotli implements CompressorInterface
{

    public function __construct()
    {
        if (!extension_loaded('brotli')) {
            throw new ExpectationFailedException("The extension BROTLI is not loaded");
        }
    }

    public function compress(string $text): string
    {
        return brotli_compress($text);
    }

    public function decompress(string $text): string
    {
        return brotli_uncompress($text);
    }
}