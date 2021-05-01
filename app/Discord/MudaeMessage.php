<?php
declare(strict_types=1);

namespace App\Discord;

use JetBrains\PhpStorm\Immutable;

#[Immutable]
class MudaeMessage
{
    public function __construct(
        public ?string $text,
        public ?MudaeEmbed $mudaeEmbed
    ) {}
}
