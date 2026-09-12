<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\Contracts\EngineExportableInterface;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;

abstract class AbstractFileHandler implements FileHandleableInterface, EngineExportableInterface
{

    protected bool $read_only;
    protected string $file_path;
    protected $handler;

    protected CompressorInterface $engine;


    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
        $this->engine = $this->getEngine();
    }

    public function isReadable(): bool
    {
        return $this->read_only;
    }

    public function isWritable(): bool
    {
        return !$this->read_only;
    }

    public function __destruct()
    {
        $this->close();
    }

    protected function load(bool $read_only = false): static
    {
        $this->read_only = $read_only;
        $this->handler = fopen($this->file_path, $this->read_only ? 'r' : 'w') or $this->launchError("The file '{$this->file_path}' can not be opened", 1);
        return $this;
    }

    public function close(): static
    {
        if (!empty($this->handler)) {
            fclose($this->handler) or $this->launchError("File is not closeable", 4);
            unset($this->handler);
        }
        return $this;
    }

    protected function launchError(string $message, int $errorno): never
    {
        throw new Exception($message, $errorno);
    }
}