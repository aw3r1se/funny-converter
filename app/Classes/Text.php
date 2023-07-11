<?php

namespace App\Classes;

use App\Contracts\HasText;
use App\Traits\TextableTrait;

class Text extends Element implements HasText
{
    use TextableTrait;

    protected static string $tag = 'p';
}
