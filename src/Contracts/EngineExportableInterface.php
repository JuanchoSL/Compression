<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface EngineExportableInterface
{

    public static function getEngine(): CompressorInterface;
}