<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileCreateableInterface extends EngineExportableInterface
{

    public static function getExtension(): string;
    public static function compress(string $origin_file_path, ?string $destiny_file_path = null): string;
}