<?php
declare(strict_types=1);

namespace App\Mudae\Actions;

use App\Mudae\ImageNumberInfo;

class ImageAction extends AbstractCharacterAction
{
    public function getImageNumberInfo(): ImageNumberInfo
    {
        return ImageNumberInfo::parseByFooterText($this->mudaeMessage->mudaeEmbed->footer, $this->isCustom());
    }
}
