<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileHandleableInterface
{

    //protected function load(bool $read_only = false): static;

    /**
     * Open the file in the rigth mode, read or write
     * @return static The same object
     */
    public function open(): static;

    /**
     * Close the file handler
     * @return static The same object
     */
    public function close(): static;

}