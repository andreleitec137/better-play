<?php

namespace BetterPlay\Domain\Entity\Traits;

trait EntityTraits
{


    public function __get($atrib)
    {
        if (isset($atrib) and $atrib !== 'id') return $this->$atrib;

        $className = get_class($this);
        throw new Exception("Attribute {$atrib} not found in the class {$className}");
    }


    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function activate()
    {
        $this->isActive = true;

        $this->validate();
    }

    public function disable()
    {
        $this->isActive = false;

        $this->validate();
    }
}
