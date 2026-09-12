<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Zlib;

use JuanchoSL\Compression\Contracts\FileWritableInterface;
use JuanchoSL\Compression\Contracts\FileCreateableInterface;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\FileCreatorTrait;

class ZlibFileWriter extends ZlibFileHandler implements FileHandleableInterface, FileWritableInterface, FileCreateableInterface
{

    use FileCreatorTrait;

    public function open(): static
    {
        return $this->load(false);
    }

    public function write(string $data): static
    {
        if (empty($this->handler)) {
            $this->open();
        }
        gzwrite($this->handler, $data) or $this->launchError("File is not writable", 3);
        return $this;
    }

}