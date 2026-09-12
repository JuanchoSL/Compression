<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileHandleableInterface
{

    //protected function load(bool $read_only = false): static;
    public function open(): static;
    public function close(): static;

}