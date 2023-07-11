<?php

namespace App\Classes;

use App\Exceptions\IncorrectJsonProvided;

abstract class ElementBuilder
{
    /**
     * @throws IncorrectJsonProvided
     */
    public static function create(array $data = []): Element
    {
        return match ($data['type']) {
            'container' => new Container($data),
            'block' => new Block($data),
            'text' => new Text($data),
            'image' => new Image($data),
            'button' => new Button($data),
            default => throw new IncorrectJsonProvided(),
        };
    }
}
