<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface DigestableInterface
{
    /**
     * Prode the dictionary to use when compress/decompress data
     * @param string $dictionary Dictionary to use
     * @return static The object
     */
    public function setDictionary(string $dictionary): static;
}