<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Traits;

trait FileCreatorTrait
{

    public static function compress(string $origin_file_path, ?string $destiny_file_path = null): string
    {
        $origin_file_path = realpath($origin_file_path);
        if (empty($destiny_file_path)) {
            $destiny_file_path = $origin_file_path;
        }
        $destiny_file_path = realpath($destiny_file_path);
        if (pathinfo($destiny_file_path, PATHINFO_EXTENSION) !== static::getExtension()) {
            $destiny_file_path .= '.' . static::getExtension();
        }
        $contents = file_get_contents($origin_file_path);
        file_put_contents($destiny_file_path, static::getEngine()->compress($contents));
        return $destiny_file_path;
    }
}