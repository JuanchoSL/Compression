<?php declare(strict_types=1);

namespace JuanchoSL\Compression\Contracts;

interface FileCreateableInterface extends EngineExportableInterface
{

    /**
     * Returns the rigth extension for the called file type
     * @return string The file extension
     */
    public static function getExtension(): string;

    /**
     * Read a file from a full filepath, compress and save into another new file
     * @param string $origin_file_path Path to file to read
     * @param mixed $destiny_file_path Path to save the compressed file. If empty, the same dir+file_name is used adding the rigth file extension
     * @return string The new compressed file_path
     */
    public static function compress(string $origin_file_path, ?string $destiny_file_path = null): string;
}