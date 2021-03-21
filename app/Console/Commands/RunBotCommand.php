<?php

namespace App\Console\Commands;

use Discord\Discord;
use Discord\Helpers\Collection;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Channel\Message;
use Discord\Parts\Guild\Guild;
use Discord\WebSockets\Event;
use Illuminate\Console\Command;

class RunBotCommand extends Command
{
    protected $signature = 'project:run-bot';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $discord = app(Discord::class);

        $discord->on('ready', function () {
            echo "Bot is ready.", PHP_EOL;
        });

        $discord->on(Event::GUILD_CREATE, function (Guild $guild) {
            /** @var Guild $guild */
            foreach ($guild->channels as $channel) {
                /** @var Channel $channel */
                $channel->getMessageHistory([])->done(function (Collection $messages) {
                    /** @var Message[] $messagesInAscendingOrder */
                    $messagesInAscendingOrder = array_reverse($messages->toArray());

                    $mudaeBotIds = config('project.mudaeBotIds');

                    // Replay message history.
                    foreach ($messagesInAscendingOrder as $message) {
                        if (!in_array($message->user_id, $mudaeBotIds, true)) {
                            // Message was not from the Mudae bot.
                            continue;
                        }
                        // Handle without update. We'll update after the loop.
                        $this->info(json_encode($message->getRawAttributes()));
                        $this->line(json_encode($message, JSON_PRETTY_PRINT));
                    }
                });
            }
        });

        $discord->run();

        return 0;
    }
}
