<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\XzLzma;

use JuanchoSL\Compression\Contracts\FileCreateableInterface;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileWritableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\FileCreatorTrait;
use JuanchoSL\Compression\FileHandlers\Traits\FileMemWriterTrait;

class XzLzmaFileWriter extends XzLzmaFileHandler implements FileHandleableInterface, FileWritableInterface, FileCreateableInterface
{

    use FileCreatorTrait, FileMemWriterTrait;

    public function open():static
    {
        return $this->load(false);
    }

}