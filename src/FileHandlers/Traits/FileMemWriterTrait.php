<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Traits;

trait FileMemWriterTrait
{

    protected string $contents = '';

    public function write(string $data): static
    {
        $this->contents .= $data;
        return $this;
    }
    public function close(): static
    {
        file_put_contents($this->file_path, $this->getEngine()->compress($this->contents));
        return parent::close();
    }
}