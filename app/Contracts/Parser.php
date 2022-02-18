<?php

declare(strict_types=1);

namespace App\Contracts;

interface Parser
{
    public function setLink(string $link): self;

    public function parse(): void;
}
