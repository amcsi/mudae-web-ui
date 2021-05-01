<?php
declare(strict_types=1);

namespace Tests\Unit\Mudae;

use App\Discord\MudaeEmbed;
use App\Mudae\SourceAndGender;
use Tests\UnitTestCase;

class SourceAndGenderTest extends UnitTestCase
{
    /**
     * @dataProvider provideParseByMudaeEmbed
     */
    public function testParseByMudaeEmbed($expectedIsMale, $expectedIsFemale, $text)
    {
        $mudaeEmbed = new MudaeEmbed('', "bla\n$text\nbla");

        $sourceAndGender = SourceAndGender::parseByMudaeEmbed($mudaeEmbed);

        self::assertSame($expectedIsMale, $sourceAndGender->isMale);
        self::assertSame($expectedIsFemale, $sourceAndGender->isFemale);
    }

    public function provideParseByMudaeEmbed(): array
    {
        return [
            [true, false, 'Happiness! <:male:452470164529872899> '],
            [false, true, 'Happiness! <:female:452463537508450304> '],
            [true, true, 'Happiness! <:female:452463537508450304><:male:452470164529872899> '],
        ];
    }
}
