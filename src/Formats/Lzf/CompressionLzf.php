<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Lzf;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionLzf implements CompressorInterface
{

    public function __construct()
    {
        if (!extension_loaded('lzf')) {
            throw new ExpectationFailedException("The extension LZF is not loaded");
        }
    }

    public function compress(string $text): string
    {
        return lzf_compress($text);
    }

    public function decompress(string $text): string
    {
        return lzf_decompress($text);
    }
}