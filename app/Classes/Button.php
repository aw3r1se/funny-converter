<?php

namespace App\Classes;

use App\Contracts\HasLink;
use App\Contracts\HasText;
use App\Traits\LinkableTrait;
use App\Traits\TextableTrait;

class Button extends Element implements HasText, HasLink
{
    use TextableTrait;
    use LinkableTrait;

    protected static string $tag = 'button';
}
