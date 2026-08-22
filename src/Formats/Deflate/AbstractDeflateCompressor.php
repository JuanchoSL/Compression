<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Deflate;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;

/**
 * Compression compatible with DEFLATE format data
 * @link https://datatracker.ietf.org/doc/html/rfc1951
 */
abstract class AbstractDeflateCompressor implements CompressorInterface
{

    protected int $level = -1;

    public function __construct(?int $level = null)
    {
        if (!is_null($level)) {
            if ($level < 0 || $level > 9) {
                throw new Exception("The value only can be between 0 (no compression) an 9 (max compression)");
            }
            $this->level = $level;
        }
    }

    public function compress(string $text): string|false
    {
        return gzdeflate($text, $this->level, $this->getEncoding());
    }

    public function decompress(string $text): string|false
    {
        return gzinflate($text);
    }

    abstract protected function getEncoding();

}