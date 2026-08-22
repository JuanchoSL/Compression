<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Zstd;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionZstd implements CompressorInterface
{
    protected int $level = -1;

    public function __construct(?int $level = null)
    {
        if (!extension_loaded('zstd')) {
            throw new ExpectationFailedException("The extension ZSTD is not loaded");
        }
        if (!is_null($level)) {
            if ($level < 1 || $level > 22) {
                throw new Exception("The value only can be between 1 (no compression) and 22 (max compression)");
            }
            $this->level = $level;
        }
    }

    public function compress(string $text): string
    {
        return zstd_compress($text, $this->level);
    }

    public function decompress(string $text): string
    {
        return zstd_uncompress($text);
    }
}