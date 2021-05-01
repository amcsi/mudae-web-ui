<?php
declare(strict_types=1);

namespace App\Mudae;

class ImageNumberInfo
{
    public function __construct(
        public int $currentImageNumber,
        public int $totalImageCount,
        public int $customImageCount
    ) {}

    public static function parseByFooterText(string $footerText, bool $isCustom): self
    {
        $match = preg_match('#^(\d+) / (\d+)(?: \[(\d+)])?$#', $footerText, $matches, PREG_UNMATCHED_AS_NULL);

        if (!$match) {
            throw new \InvalidArgumentException("Could not parse image number info by footer text:\n$footerText");
        }

        return new self((int) $matches[1], (int) $matches[2], (int) ($isCustom ? $matches[2] : $matches[3]));
    }
}
