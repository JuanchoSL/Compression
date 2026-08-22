<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Zlib;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;

/**
 * Compression compatible with ZLIB format data
 * @link https://datatracker.ietf.org/doc/html/rfc1950
 */
abstract class AbstractZlibCompressor implements CompressorInterface
{

    protected int $level = -1;

    public function __construct(?int $level = null)
    {
        if (!extension_loaded('zlib')) {
            throw new ExpectationFailedException("The extension ZLIB is not loaded");
        }
        if (!is_null($level)) {
            if ($level < 0 || $level > 9) {
                throw new Exception("The value only can be between 0 (no compression) and 9 (max compression)");
            }
            $this->level = $level;
        }
    }

    public function compress(string $text): string|false
    {
        return zlib_encode($text, $this->getEncoding(), $this->level);
    }

    public function decompress(string $text): string|false
    {
        return zlib_decode($text);
    }

    abstract protected function getEncoding();
}