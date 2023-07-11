<?php

namespace App\Traits;

trait TextableTrait
{
    protected string $text;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }
}
