<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface CompressableInterface
{
    /**
     * Compress a text using the selected compressor
     * @param string $text Text to compress
     * @return string|false the compressed text or false if error
     */
    public function compress(string $text): string|false;
}