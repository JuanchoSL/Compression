<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Snappy;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionSnappy implements CompressorInterface
{

    public function __construct()
    {
        if (!extension_loaded('snappy')) {
            throw new ExpectationFailedException("The extension Snappy is not loaded");
        }
    }

    public function compress(string $text): string|false
    {
        return snappy_compress($text);
    }

    public function decompress(string $text): string|false
    {
        return snappy_uncompress($text);
    }
}