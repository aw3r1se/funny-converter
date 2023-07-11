<?php

namespace App\Classes;

use App\Exceptions\IncorrectJsonProvided;

class Json extends File
{
    protected static ?string $extension = 'json';

    public function render(): static
    {
        // TODO: Implement render() method.

        return $this;
    }

    public function fillTree(): static
    {
        $root = null;
        $parent = null;

        $this->traverse(
        /** @throws IncorrectJsonProvided */
            function (array $data, bool $has_children) use (&$root, &$parent) {
                $elem = ElementBuilder::create($data);

                $parent = $parent ?? $elem;
                if (empty($root)) {
                    $root = $elem;
                    return;
                }

                $parent->appendChild($elem);
                if ($has_children) {
                    $parent = $elem;
                }
            }
        );

        $this->root = $root;

        return $this;
    }

    public function traverse(callable $callback)
    {
        $data = json_decode($this->contents, true);
        $this->recursiveTraverse([$data], $callback);
    }

    protected function recursiveTraverse(array $data, callable $callback)
    {
        foreach ($data as $item) {
            $has_children = isset($item['children']);
            $callback($item, $has_children);

            if ($has_children) {
                $this->recursiveTraverse($item['children'], $callback);
            }
        }
    }
}
