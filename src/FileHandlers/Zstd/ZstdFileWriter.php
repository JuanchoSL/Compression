<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Zstd;

use JuanchoSL\Compression\Contracts\FileCreateableInterface;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileWritableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\FileCreatorTrait;

class ZstdFileWriter extends ZstdFileHandler implements FileHandleableInterface, FileWritableInterface, FileCreateableInterface
{

    use FileCreatorTrait;

    protected int $level;

    public function __construct(string $file_path, int $level = ZSTD_COMPRESS_LEVEL_DEFAULT)
    {
        $this->level = $level;
        parent::__construct($file_path);
    }

    public function open(): static
    {
        $this->context = \Zstd\compress_init($this->level);
        return $this->load(false);
    }

    public function write(string $data): static
    {
        if (empty($this->context)) {
            $this->open();
        }
        parent::write(\Zstd\compress_add($this->context, $data, false)) or $this->launchError("File is not writable", 3);
        return $this;
    }
    public function close(): static
    {
        if (!empty($this->handler)) {
            if ($this->context instanceof \Zstd\Compress\Context) {
                fwrite($this->handler, \Zstd\compress_add($this->context, '', true));
            }
            fclose($this->handler) or $this->launchError("File is not closeable", 4);
            unset($this->handler);
            unset($this->context);
        }
        return $this;
    }
}