<?php
declare(strict_types=1);

namespace Tests\Unit\Discord;

use App\Discord\MessageParser;
use App\Discord\MudaeEmbed;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Image;
use GuzzleHttp\Utils;
use Tests\UnitTestCase;

class MessageParserTest extends UnitTestCase
{
    public function test_parse_character_roll(): void
    {
        $instance = new MessageParser();
        $message = $this->createMessageByJson(file_get_contents(__DIR__ . '/characterRoll.json'));
        $result = $instance->parse($message)->mudaeEmbed;

        self::assertInstanceOf(MudaeEmbed::class, $result);

        self::assertSame('Retz', $result->name);
        self::assertSame("Hunter × Hunter\nReact with any emoji to claim!\n(Read **\$togglereact**)", $result->description);
        self::assertInstanceOf(Image::class, $result->image);
        self::assertSame('https://media.discordapp.net/attachments/472313197836107780/650839496719466503/ADdmMN7.png', $result->image->url);
        self::assertSame(225, $result->image->width);
        self::assertSame(350, $result->image->height);
        self::assertNull($result->footer);
    }

    public function test_parse_character_check(): void
    {
        $instance = new MessageParser();
        $message = $this->createMessageByJson(file_get_contents(__DIR__ . '/characterCheck.json'));
        $result = $instance->parse($message)->mudaeEmbed;

        self::assertInstanceOf(MudaeEmbed::class, $result);

        self::assertSame('Retz', $result->name);
        self::assertSame("Hunter × Hunter <:female:452463537508450304>\n*Animanga roulette* · **41**<:kakera:469835869059153940>\nClaim Rank: #8532\nLike Rank: #16135", $result->description);
        self::assertInstanceOf(Image::class, $result->image);
        self::assertSame('https://media.discordapp.net/attachments/472313197836107780/650839496719466503/ADdmMN7.png', $result->image->url);
        self::assertSame('1 / 7', $result->footer);
    }

    private function createMessage()
    {
        $discord = new Discord(['token' => '']);
        return new Message($discord);
    }

    private function createMessageByJson(string $json)
    {
        $message = $this->createMessage();
        $message->unserialize(serialize(Utils::jsonDecode($json)));

        return $message;
    }
}
