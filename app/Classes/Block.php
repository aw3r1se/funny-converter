<?php

namespace App\Classes;

use App\Contracts\HasText;
use App\Traits\TextableTrait;

class Block extends Element implements HasText
{
    use TextableTrait;

    protected static string $tag = 'div';
}
