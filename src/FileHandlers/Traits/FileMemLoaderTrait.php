<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Traits;

trait FileMemLoaderTrait
{

    protected function load(bool $read_only = false): static
    {
        parent::load($read_only);
        $this->handler = fopen('php://memory', 'rw');
        fwrite($this->handler, $this->getEngine()->decompress(file_get_contents($this->file_path)));
        rewind($this->handler);
        return $this;
    }
}