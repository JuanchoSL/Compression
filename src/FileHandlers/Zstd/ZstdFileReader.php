<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Zstd;

use JuanchoSL\Compression\FileHandlers\Traits\StringableTrait;
use Stringable;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileReadableInterface;

class ZstdFileReader extends ZstdFileHandler implements Stringable, FileHandleableInterface, FileReadableInterface
{

    use StringableTrait;

    public function open(): static
    {
        $this->context = zstd_uncompress_init();
        return $this->load(true);
    }

    public function read(int $length = 1024)
    {
        if (empty($this->handler) || empty($this->context)) {
            $this->open();
        }
        $data = zstd_uncompress_add($this->context, parent::read($length));// or $this->launchError("File '{$this->file_path}' is not readable,", 2);
        return $data;
    }

    public function close(): static
    {
        if (!empty($this->handler)) {
            fclose($this->handler) or $this->launchError("File is not closeable", 4);
            unset($this->handler);
            unset($this->context);
        }
        return $this;
    }
}