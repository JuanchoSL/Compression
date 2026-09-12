<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileWritableInterface
{

    public function isWritable(): bool;
    public function write(string $data);
}