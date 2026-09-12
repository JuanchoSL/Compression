<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Traits;

trait FileWriterTrait
{

    public function write(string $data): static
    {
        if (empty($this->handler)) {
            $this->load(false);
        }
        fwrite($this->handler, $data);// or $this->launchError("File is not writable", 3);
        return $this;
    }

}