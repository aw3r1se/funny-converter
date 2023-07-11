<?php

namespace App\Services;

use App\Classes\File;
use App\Classes\Html;
use App\Classes\Json;
use App\Contracts\ParserServiceInterface;
use App\Exceptions\NotImplementedType;
use Exception;

class JsonParserService implements ParserServiceInterface
{
    protected ?Json $file;

    protected ?string $to;

    /**
     * @param Json $file
     * @return $this
     */
    public function setFile(File $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function to(string $to): static
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @throws NotImplementedType|Exception
     */
    public function handle(): File
    {
        return call_user_func([
            $this,
            call_user_func([
                $this->to,
                'getExtension',
            ]),
        ]);
    }

    protected function html(): Html
    {
        $root = $this->file
            ->fillTree()
            ->getRoot();

        $html = new Html();
        $html->setRoot($root)
            ->render();

        return $html;
    }
}
