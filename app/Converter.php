<?php

namespace App;

use App\Classes\File;
use App\Contracts\ParserServiceInterface;
use App\Exceptions\InvalidFileType;

class Converter
{
    protected array $from;
    protected array $to;

    protected ?File $file = null;
    protected ParserServiceInterface $service;

    public function __construct(array $configuration)
    {
        $this->service = new $configuration['parser']();
        $this->from = $configuration['from'];
        $this->to = $configuration['to'];
    }

    public function run(?string $filename = null): void
    {
        $files = $filename
            ? [$this->from . $filename]
            : scandir($this->from['folder']);

        foreach ($files ?: [] as $filename) {
            $path = $this->from['folder'] . $filename;
            try {
                $this->file = new $this->from['entity']($path);
                $this->convert()
                    ->store();
            } catch (InvalidFileType) {
                continue;
            }
        }
    }

    public function convert(): static
    {
        $this->file = $this->service
            ->setFile($this->file)
            ->to($this->to['entity'])
            ->handle();

        return $this;
    }

    public function store(): static
    {
        $this->file
            ->save($this->to['folder'] . $this->file->getName());

        return $this;
    }
}
