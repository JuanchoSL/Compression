<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Zstd;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\Contracts\DigestableInterface;
use JuanchoSL\Compression\Formats\Traits\DigestDictionaryTrait;
use JuanchoSL\Exceptions\ExpectationFailedException;
use JuanchoSL\Validators\Types\Numbers\NumberValidation;

class CompressionZstd implements CompressorInterface, DigestableInterface
{

    use DigestDictionaryTrait;

    protected ?int $level = null;

    public function __construct(?int $level = null)
    {
        if (!extension_loaded('zstd')) {
            throw new ExpectationFailedException("The extension ZSTD is not loaded");
        }
        defined('ZSTD_COMPRESS_LEVEL_MIN') or define('ZSTD_COMPRESS_LEVEL_MIN', 1);
        defined('ZSTD_COMPRESS_LEVEL_MAX') or define('ZSTD_COMPRESS_LEVEL_MAX', 22);
        defined('ZSTD_COMPRESS_LEVEL_DEFAULT') or define('ZSTD_COMPRESS_LEVEL_DEFAULT', 3);

        $level = is_null($level) ? ZSTD_COMPRESS_LEVEL_DEFAULT : $level;
        if (!NumberValidation::isValueIntoRange($level, ZSTD_COMPRESS_LEVEL_MIN, ZSTD_COMPRESS_LEVEL_MAX)) {
            throw new Exception(sprintf("The value only can be between %d (no compression) and %d (max compression)", ZSTD_COMPRESS_LEVEL_MIN, ZSTD_COMPRESS_LEVEL_MAX));
        }
        $this->level = $level;
    }

    public function compress(string $text): string|false
    {
        return zstd_compress($text, $this->level, $this->dictionary);
    }

    public function decompress(string $text): string|false
    {
        return zstd_uncompress($text, $this->dictionary);
    }
}