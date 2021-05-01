<?php
declare(strict_types=1);

namespace App\Mudae\Actions;

use App\Discord\MudaeMessage;

abstract class AbstractMudaeAction
{
    public function __construct(protected MudaeMessage $mudaeMessage) {}
}
