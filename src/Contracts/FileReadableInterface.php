<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileReadableInterface
{

    /**
     * Check if a file handler is opened and ready for read
     * @return bool true if is opened and ready for read or false otherwhise
     */
    public function isReadable(): bool;

    /**
     * Read and return the amount of bytes from the file
     * @param int $length Amount of bytes to read
     * @return string The readed data or false
     */
    public function read(int $length = 1024);
}