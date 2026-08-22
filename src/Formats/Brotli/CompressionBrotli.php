<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Brotli;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionBrotli implements CompressorInterface
{

    protected int $level = 5;

    public function __construct(?int $level = null)
    {
        if (!extension_loaded('brotli')) {
            throw new ExpectationFailedException("The extension BROTLI is not loaded");
        }
        if (!is_null($level)) {
            if ($level < 0 || $level > 11) {
                throw new Exception("The value only can be between 0 (no compression) an 11 (max compression)");
            }
            $this->level = $level;
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