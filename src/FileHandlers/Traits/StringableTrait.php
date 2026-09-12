<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Traits;

trait StringableTrait
{

    public function __invoke(int $bytes = 4096)
    {
        if (empty($this->handler)) {
            $this->load(true);
        }
        $decompressed_part = '';
        while (!feof($this->handler)) {
            yield $read = $this->read($bytes);
            $decompressed_part .= $read;
        }
        $this->close();
        return $decompressed_part;
    }

    public function __tostring(): string
    {
        $gen = $this();
        foreach ($gen as $block) {
        }
        return $gen->getReturn();
    }

}