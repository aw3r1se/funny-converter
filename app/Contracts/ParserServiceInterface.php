<?php

namespace App\Contracts;

use App\Classes\File;

interface ParserServiceInterface
{
    public function setFile(File $file): static;

    public function to(string $to): static;

    public function handle(): File;
}
