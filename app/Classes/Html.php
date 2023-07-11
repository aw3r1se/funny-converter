<?php

namespace App\Classes;

use DOMDocument;
use DOMElement;

class Html extends File
{
    protected static ?string $extension = 'html';

    public function render(): static
    {
        $content = new DOMDocument();
        $this->traverseTree(function (Element $element) use ($content) {
            //
        });

        $content->saveHTMLFile('123123');

        return $this;
    }
}
