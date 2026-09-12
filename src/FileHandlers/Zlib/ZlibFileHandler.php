<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Zlib;

use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\FileHandlers\AbstractFileHandler;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Formats\Deflate\CompressionGzip;

abstract class ZlibFileHandler extends AbstractFileHandler implements FileHandleableInterface
{
    public static function getEngine(): CompressorInterface
    {
        return new CompressionGzip();
    }
    public static function getExtension(): string
    {
        return 'gz';
    }

    protected function load(bool $read_only = false): static
    {
        $this->read_only = $read_only;
        $this->handler = gzopen($this->file_path, $this->read_only ? 'r' : 'w') or $this->launchError("The file '{$this->file_path}' can not be opened", 1);
        return $this;
    }

    public function close(): static
    {
        if (!empty($this->handler)) {
            gzclose($this->handler) or $this->launchError("File is not closeable", 4);
            unset($this->handler);
        }
        return $this;
    }

}