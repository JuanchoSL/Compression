<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Lz4;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\FileHandlers\AbstractFileHandler;
use JuanchoSL\Compression\Formats\Lz4\CompressionLz4;

abstract class Lz4FileHandler extends AbstractFileHandler
{

    public static function getEngine(): CompressorInterface
    {
        return new CompressionLz4();
    }
    public static function getExtension(): string
    {
        return 'lz4';
    }

}