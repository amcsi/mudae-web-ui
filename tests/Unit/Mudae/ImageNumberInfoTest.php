<?php
declare(strict_types=1);

namespace Tests\Unit\Mudae;

use App\Mudae\ImageNumberInfo;
use Tests\UnitTestCase;

class ImageNumberInfoTest extends UnitTestCase
{
    /**
     * @dataProvider provideParseByFooterText
     */
    public function testParseByFooterText(
        int $expectedCurrentImageNumber,
        int $expectedTotalImageCount,
        int $expectedCustomImageCount,
        string $footerText,
        bool $isCustom
    ) {
        $result = ImageNumberInfo::parseByFooterText($footerText, $isCustom);

        self::assertSame($expectedCurrentImageNumber, $result->currentImageNumber);
        self::assertSame($expectedTotalImageCount, $result->totalImageCount);
        self::assertSame($expectedCustomImageCount, $result->customImageCount);
    }

    public function provideParseByFooterText(): array
    {
        return [
            [2, 3, 1, '2 / 3 [1]', false],
            [2, 3, 0, '2 / 3', false],
            [2, 3, 3, '2 / 3', true],
        ];
    }
}
