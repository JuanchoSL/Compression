<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface CompressableInterface
{
    /**
     * Compress a text using the selected compressor
     * @param string $text Text to compress
     * @return string the compressed text
     */
    public function compress(string $text): string;
}