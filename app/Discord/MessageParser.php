<?php
declare(strict_types=1);

namespace App\Discord;

use Discord\Parts\Channel\Message;

class MessageParser
{
    public function parse(Message $message): MudaeMessage
    {
        $text = $message->content;

        if (isset($message->embeds[0])) {
            $embed = $message->embeds[0];

            $mudaeEmbed = new MudaeEmbed($embed->author->name, $embed->description, $embed->image, $embed->footer->text);
        }

        return new MudaeMessage($text, $mudaeEmbed);
    }
}
