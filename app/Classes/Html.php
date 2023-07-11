<?php

namespace App\Classes;

use DOMDocument;

class Html extends File
{
    protected static ?string $extension = 'html';

    public function render(): static
    {
        $root = null;
        $parent = null;

        $this->traverseTree(function (Element $element, bool $has_children) use (&$root, &$parent) {
            $element = $element->getDomNode();
            $parent = $parent ?? $element;

            if (empty($root)) {
                $root = new DOMDocument();
                $root->appendChild($parent);
                return;
            }

            $parent->appendChild($element);
            if ($has_children) {
                $parent = $element;
            }
        });

        $this->contents = $root->saveHTML();

        return $this;
    }
}
