<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface DecompressableInterface
{

    /**
     * Decompress a text using the selected compressor
     * @param string $text The compressed text
     * @return string|false The decompressed text or false if error
     */
    public function decompress(string $text): string|false;
}