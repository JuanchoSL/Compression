<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileWritableInterface
{

    /**
     * Check if a file handler is opened and ready for writing
     * @return bool true if is opened and ready for write or false otherwhise
     */
    public function isWritable(): bool;

    /**
     * Write the data into selected file encoding it
     * @param string $data The data to write
     * @return static
     */
    public function write(string $data): static;
}