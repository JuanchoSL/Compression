<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\XzLzma;

use JuanchoSL\Compression\FileHandlers\AbstractFileHandler;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\Formats\XzLzma\CompressionXzLzma;

abstract class XzLzmaFileHandler extends AbstractFileHandler
{

    public static function getEngine(): CompressorInterface
    {
        return new CompressionXzLzma();
    }
    public static function getExtension(): string
    {
        return 'xz';
    }

}