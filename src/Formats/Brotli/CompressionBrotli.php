<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Brotli;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\Contracts\DigestableInterface;
use JuanchoSL\Compression\Formats\Traits\DigestDictionaryTrait;
use JuanchoSL\Exceptions\ExpectationFailedException;

class CompressionBrotli implements CompressorInterface, DigestableInterface
{

    use DigestDictionaryTrait;

    protected int $level = 5;

    public function __construct(?int $level = null)
    {
        if (!extension_loaded('brotli')) {
            throw new ExpectationFailedException("The extension BROTLI is not loaded");
        }
        defined('BROTLI_GENERIC') or define('BROTLI_GENERIC', 0);
        defined('BROTLI_TEXT') or define('BROTLI_TEXT', 1);
        defined('BROTLI_FONT') or define('BROTLI_FONT', 2);
        defined('BROTLI_COMPRESS_LEVEL_MIN') or define('BROTLI_COMPRESS_LEVEL_MIN', 0);
        defined('BROTLI_COMPRESS_LEVEL_MAX') or define('BROTLI_COMPRESS_LEVEL_MAX', 11);
        defined('BROTLI_COMPRESS_LEVEL_DEFAULT') or define('BROTLI_COMPRESS_LEVEL_DEFAULT', 11);
        defined('BROTLI_DICTIONARY_SUPPORT') or define('BROTLI_DICTIONARY_SUPPORT', 1);
        $level ??= BROTLI_COMPRESS_LEVEL_DEFAULT;
        if ($level < BROTLI_COMPRESS_LEVEL_MIN || $level > BROTLI_COMPRESS_LEVEL_MAX) {
            throw new Exception(sprintf("The value only can be between %d (no compression) an %d (max compression)", BROTLI_COMPRESS_LEVEL_MIN, BROTLI_COMPRESS_LEVEL_MAX));
        }
        $this->level = $level;

    }

    public function compress(string $text): string|false
    {
        $level = BROTLI_DICTIONARY_SUPPORT ? max($this->level, 5) : $this->level;
        return brotli_compress($text, $level, BROTLI_GENERIC, BROTLI_DICTIONARY_SUPPORT ? $this->dictionary : null);
    }

    public function decompress(string $text): string|false
    {
        return brotli_uncompress($text, BROTLI_DICTIONARY_SUPPORT ? $this->dictionary : null);
    }
}