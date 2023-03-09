<?php

use BetterPlay\Domain\Entity\Traits;

trait EntityTraits
{

    public function __set($atrib, $value)
    {
        $this->$atrib = $value;
    }

    public function __get($atrib)
    {
        if (isset($atrib)) return $this->$atrib;

        $className = get_class($this);
        throw new Exception("Attribute {$atrib} not found in the class {$className}");
    }
}
