<?php

namespace App\Classes;

use DOMElement;
use DOMException;

abstract class Element
{
    protected DOMElement $dom_node;
    protected static string $tag;

    /** @var array<Element> */
    protected array $children = [];

    /**
     * @throws DOMException
     */
    public function __construct(array $data)
    {
        $this->dom_node = new DOMElement(static::$tag);
    }

    public function getDomNode(): DOMElement
    {
        return $this->dom_node;
    }

    //abstract function render(): static;

    public function getChildren(): array
    {
        return $this->children;
    }

    public function appendChild(Element $element): static
    {
        $this->children[] = $element;

        return $this;
    }
}
