<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Bzip2;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionBzip2 implements CompressorInterface
{

    protected int $level = 4;

    public function __construct(?int $level = null)
    {
        if (!extension_loaded('bz2')) {
            throw new ExpectationFailedException("The extension BZIP2 is not loaded");
        }
        if (!is_null($level)) {
            if ($level < 1 || $level > 9) {
                throw new Exception("The value only can be between 1 (no compression) an 9 (max compression)");
            }
            $this->level = $level;
        }
    }

    public function compress(string $text): string
    {
        return bzcompress($text, $this->level);
    }
    public function decompress(string $text): string
    {
        return bzdecompress($text);
    }
}