<?php

namespace App\Classes;

use App\Contracts\HasLink;
use App\Traits\LinkableTrait;

class Image extends Element implements HasLink
{
    use LinkableTrait;
}
