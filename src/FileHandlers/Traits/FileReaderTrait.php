<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Traits;

trait FileReaderTrait
{

    public function read(int $length = 1024)
    {
        if (empty($this->handler)) {
            $this->load(true);
        }
        $data = fread($this->handler, $length);// or $this->launchError("File is not readable.", 2);
        return $data;
    }

}