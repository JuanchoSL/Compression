<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Zlib;

use JuanchoSL\Compression\Contracts\EngineExportableInterface;
use Stringable;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileReadableInterface;

class ZlibFileReader extends ZlibFileHandler implements FileHandleableInterface, FileReadableInterface, Stringable, EngineExportableInterface
{

    public function open(): static
    {
        return $this->load(true);
    }

    public function read(int $length = 1024)
    {
        if (empty($this->handler)) {
            $this->open();
        }
        $data = gzread($this->handler, $length) or $this->launchError("File is not readable", 2);
        return $data;
    }

    public function __invoke(int $bytes = 4096)
    {
        if (empty($this->handler)) {
            $this->load(true);
        }
        $decompressed_part = [];
        while (!gzeof($this->handler)) {
            yield $decompressed_part[] = $this->read($bytes);
        }
        $this->close();
        return implode('', $decompressed_part);
    }

    public function __tostring(): string
    {
        $gen = $this();
        foreach ($gen as $block) {
        }
        return $gen->getReturn();
    }
}