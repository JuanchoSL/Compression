<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Brotli;

use JuanchoSL\Compression\Contracts\FileCreateableInterface;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileWritableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\FileCreatorTrait;
use JuanchoSL\Compression\FileHandlers\Traits\FileMemWriterTrait;

class BrotliFileWriter extends BrotliFileHandler implements FileHandleableInterface, FileWritableInterface, FileCreateableInterface
{

    use FileCreatorTrait, FileMemWriterTrait;

    public function open():static
    {
        return $this->load(false);
    }

}