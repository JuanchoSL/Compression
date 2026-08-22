<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Formats\Traits;

trait DigestDictionaryTrait
{

    protected $dictionary = null;

    public function setDictionary($dictionary): static
    {
        $this->dictionary = $dictionary;
        return $this;
    }
}