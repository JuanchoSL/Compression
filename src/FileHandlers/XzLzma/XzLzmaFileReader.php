<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\XzLzma;

use JuanchoSL\Compression\Contracts\EngineExportableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\StringableTrait;
use Stringable;
use JuanchoSL\Compression\FileHandlers\Traits\FileReaderTrait;
use JuanchoSL\Compression\FileHandlers\Traits\FileMemLoaderTrait;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileReadableInterface;

class XzLzmaFileReader extends XzLzmaFileHandler implements FileHandleableInterface, FileReadableInterface, Stringable, EngineExportableInterface
{
    use FileMemLoaderTrait, FileReaderTrait, StringableTrait;


    public function open():static
    {
        return $this->load(true);
    }

}