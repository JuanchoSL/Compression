<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileReadableInterface
{

    public function isReadable(): bool;
    public function read(int $length = 1024);
}