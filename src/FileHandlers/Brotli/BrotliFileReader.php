<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Brotli;

use JuanchoSL\Compression\Contracts\EngineExportableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\StringableTrait;
use Stringable;
use JuanchoSL\Compression\FileHandlers\Traits\FileMemLoaderTrait;
use JuanchoSL\Compression\Contracts\FileReadableInterface;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\FileReaderTrait;

class BrotliFileReader extends BrotliFileHandler implements FileHandleableInterface, FileReadableInterface, Stringable, EngineExportableInterface
{

    use FileReaderTrait, FileMemLoaderTrait, StringableTrait;


    public function open():static
    {
        return $this->load(true);
    }

}