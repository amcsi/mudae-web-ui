<?php
declare(strict_types=1);

namespace App\Discord;

use Discord\Parts\Channel\Message;

class MessageParser
{
    public function parse(Message $message): ?MudaeEmbed
    {
        $embed = $message->embeds[0];

        return new MudaeEmbed($embed->author->name, $embed->description, $embed->image, $embed->footer->text);
    }
}
