<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Brotli;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\FileHandlers\AbstractFileHandler;
use JuanchoSL\Compression\Formats\Brotli\CompressionBrotli;

abstract class BrotliFileHandler extends AbstractFileHandler
{

    public static function getEngine(): CompressorInterface
    {
        return new CompressionBrotli();
    }
    public static function getExtension(): string
    {
        return 'br';
    }

}