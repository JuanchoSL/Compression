<?php declare(strict_types=1);

namespace JuanchoSL\Compression\FileHandlers\Bzip2;

use JuanchoSL\Compression\Contracts\EngineExportableInterface;
use JuanchoSL\Compression\FileHandlers\Traits\StringableTrait;
use Stringable;
use JuanchoSL\Validators\Types\Integers\IntegerValidation;
use JuanchoSL\Compression\Contracts\FileHandleableInterface;
use JuanchoSL\Compression\Contracts\FileReadableInterface;

class Bzip2FileReader extends Bzip2FileHandler implements FileHandleableInterface, FileReadableInterface, Stringable, EngineExportableInterface
{

    use StringableTrait;

    public function open():static
    {
        return $this->load(true);
    }

    public function read(int $length = 1024)
    {
        if (IntegerValidation::isValueGreatherThan($length, 8192)) {
            $length = 8192;
        }
        if (empty($this->handler)) {
            $this->open();
        }
        $data = \bzread($this->handler, $length) or $this->error();
        return $data;
    }

}