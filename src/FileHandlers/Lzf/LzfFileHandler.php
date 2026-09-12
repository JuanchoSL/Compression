<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Lzf;

use JuanchoSL\Compression\FileHandlers\AbstractFileHandler;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\Formats\Lzf\CompressionLzf;

abstract class LzfFileHandler extends AbstractFileHandler
{

    public static function getEngine(): CompressorInterface
    {
        return new CompressionLzf();
    }
    public static function getExtension(): string
    {
        return 'lzf';
    }

}