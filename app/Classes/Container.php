<?php

namespace App\Classes;

use App\Contracts\HasText;
use App\Traits\TextableTrait;

class Container extends Element implements HasText
{
    use TextableTrait;
}
