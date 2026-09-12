<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface EngineExportableInterface
{

    /**
     * Create and returns a new instance of a called entity
     * @return object The new instance
     */
    public static function getEngine(): CompressorInterface;
}