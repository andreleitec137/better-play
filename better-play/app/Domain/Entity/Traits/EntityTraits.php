<?php

namespace BetterPlay\Domain\Entity\Traits;

trait EntityTraits
{


    public function __get($property)
    {
        if (isset($this->{$property})) {
            return $this->{$property};
        }

        $className = get_class($this);
        throw new Exception("Property {$property} not found in class {$className}");
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
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
