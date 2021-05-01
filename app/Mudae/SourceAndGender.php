<?php
declare(strict_types=1);

namespace App\Mudae;

use App\Discord\MudaeEmbed;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
class SourceAndGender
{
    public function __construct(public string $source, public bool $isMale, public bool $isFemale) {}

    public static function parseByMudaeEmbed(MudaeEmbed $mudaeEmbed): self
    {
        $female = '<:female:452463537508450304>';
        $male = '<:male:452470164529872899>';

        $description = $mudaeEmbed->description;
        $match = preg_match("/^(.*) ((?:$female|$male)+)\s*$/m", $description, $matches);

        if (!$match) {
            throw new \RuntimeException(
                "Could not find source and gender of character.\nDescription:\n{$description}"
            );
        }

        return new self($matches[1], str_contains($matches[2], $male), str_contains($matches[2], $female));
    }
}
