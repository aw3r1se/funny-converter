<?php

namespace App\Traits;

use App\Classes\Link;

trait LinkableTrait
{
    protected Link $link;

    public function getLink(): Link
    {
        return $this->link;
    }

    public function setLink(Link $link): static
    {
        $this->link = $link;

        return $this;
    }
}
