<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\XzLzma;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Exceptions\ExpectationFailedException;
use JuanchoSL\Validators\Types\Numbers\NumberValidation;

class CompressionXzLzma implements CompressorInterface
{

    protected int $level = 5;

    public function __construct(?int $level = null)
    {
        if (!extension_loaded('xz')) {
            throw new ExpectationFailedException("The extension XZ is not loaded");
        }
        if (!is_null($level)) {
            if (!NumberValidation::isValueIntoRange($level, 0, 9)) {
                throw new Exception("The value only can be between 0 (no compression) and 9 (max compression)");
            }
            $this->level = $level;
        }
    }

    public function compress(string $text): string|false
    {
        return xzencode($text, $this->level);
    }

    public function decompress(string $text): string|false
    {
        return xzdecode($text);
    }
}