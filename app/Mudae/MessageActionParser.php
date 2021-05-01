<?php
declare(strict_types=1);

namespace App\Mudae;

use App\Discord\MudaeMessage;
use App\Mudae\Actions\AbstractMudaeAction;

class MessageActionParser
{
    public function parse(MudaeMessage $mudaeMessage): ?AbstractMudaeAction
    {
        // TODO.
    }
}
