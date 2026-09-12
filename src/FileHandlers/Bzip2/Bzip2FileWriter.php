<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Bzip2;

use JuanchoSL\Compression\FileHandlers\Traits\FileCreatorTrait;
use JuanchoSL\Compression\Contracts\FileCreateableInterface;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileWritableInterface;

class Bzip2FileWriter extends Bzip2FileHandler implements FileHandleableInterface, FileWritableInterface, FileCreateableInterface
{

    use FileCreatorTrait;

    public function open():static
    {
        return $this->load(false);
    }

    public function write(string $data): static
    {
        if (empty($this->handler)) {
            $this->open();
        }
        \bzwrite($this->handler, $data) or $this->error();
        return $this;
    }

}