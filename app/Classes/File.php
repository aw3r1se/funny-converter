<?php

namespace App\Classes;

use App\Exceptions\InvalidFileType;

abstract class File
{
    protected ?string $path;
    protected ?string $name;
    protected ?string $contents;
    protected static ?string $extension;
    protected ?Element $root;

    /**
     * @throws InvalidFileType
     */
    public function __construct(?string $path = null)
    {
        if ($path) {
            if (pathinfo($path, PATHINFO_EXTENSION) != static::$extension) {
                throw new InvalidFileType();
            }

            $this->path = $path;
            $this->name = basename($path);
            $this->contents = file_get_contents($path);
        }
    }

    abstract public function render(): static;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $name = preg_replace('#\.\w+$#iu', '', $name);
        $this->name = "$name." . static::$extension;

        return $this;
    }

    public function traverseTree(callable $callback): static
    {
        $this->traverseTreeRecursive($this->root, $callback);

        return $this;
    }

    protected function traverseTreeRecursive(Element $element, callable $callback): static
    {
        $has_children = (bool)count($element->getChildren());
        $callback($element, $has_children);

        foreach ($element->getChildren() as $child) {
            $this->traverseTreeRecursive($child, $callback);
        }

        return $this;
    }

    public static function getExtension(): string
    {
        return static::$extension;
    }

    public function getRoot(): ?Element
    {
        return $this->root;
    }

    public function setRoot(Element $root): static
    {
        $this->root = $root;

        return $this;
    }

    public function save(string $path): void
    {
        if (file_put_contents($path, $this->contents)) {
            $this->path = $path;
        }
    }
}
