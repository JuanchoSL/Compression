<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Bzip2;

use Exception;
use JuanchoSL\Compression\Contracts\CompressorInterface;
use JuanchoSL\Compression\FileHandlers\AbstractFileHandler;
use JuanchoSL\Compression\Formats\Bzip2\CompressionBzip2;

abstract class Bzip2FileHandler extends AbstractFileHandler
{


    public static function getEngine(): CompressorInterface
    {
        return new CompressionBzip2();
    }
    public static function getExtension(): string
    {
        return 'bz';
    }

    protected function load(bool $read_only = false): static
    {
        $this->read_only = $read_only;
        $this->handler = \bzopen($this->file_path, $this->read_only ? 'r' : 'w') or $this->error("The file '{$this->file_path}' can not be opened");
        return $this;
    }

    public function close(): static
    {
        if (!empty($this->handler)) {
            \bzclose($this->handler) or $this->error();
            unset($this->handler);
        }
        return $this;
    }

    protected function error(?string $message = null, ?int $errorno = null): never
    {
        $this->launchError($message ?? \bzerrstr($this->handler), $errorno ?? \bzerrno($this->handler));
    }

}