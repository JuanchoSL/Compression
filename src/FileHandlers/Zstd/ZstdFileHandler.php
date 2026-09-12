<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Zstd;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\FileHandlers\AbstractFileHandler;
use JuanchoSL\Compression\FileHandlers\Traits\FileReaderTrait;
use JuanchoSL\Compression\FileHandlers\Traits\FileWriterTrait;
use JuanchoSL\Compression\Formats\Zstd\CompressionZstd;
use Zstd as VanillaZstd;

abstract class ZstdFileHandler extends AbstractFileHandler
{

    use FileReaderTrait, FileWriterTrait;

    protected $context;

    public static function getEngine(): CompressorInterface
    {
        return new CompressionZstd();
    }

    public static function getExtension(): string
    {
        return 'zst';
    }

    public function isReadable(): bool
    {
        return ($this->context instanceof \Zstd\UnCompress\Context);
    }
    public function isWritable(): bool
    {
        return ($this->context instanceof \Zstd\Compress\Context);
    }
}