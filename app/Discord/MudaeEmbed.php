<?php
declare(strict_types=1);

namespace App\Discord;

use Discord\Parts\Embed\Image;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
class MudaeEmbed
{
    public function __construct(
        public string $name,
        public string $description,
        public ?Image $image = null,
        public ?string $footer = null
    ) {
    }
}
