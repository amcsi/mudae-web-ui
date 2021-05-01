<?php
declare(strict_types=1);

namespace App\Mudae\Actions;

use App\Mudae\SourceAndGender;

/**
 * Character roll or image view.
 */
abstract class AbstractCharacterAction extends AbstractMudaeAction
{
    public function getName()
    {
        return $this->mudaeMessage->mudaeEmbed->name;
    }

    public function getSourceAndGender(): SourceAndGender
    {
        static $sourceAndGender;

        if (!$sourceAndGender) {
            $sourceAndGender = SourceAndGender::parseByMudaeEmbed($this->mudaeMessage->mudaeEmbed);
        }

        return $sourceAndGender;
    }

    public function isCustom(): bool
    {
        return $this->getSourceAndGender()->source === 'Custom';
    }

    public function getImageUrl(): string
    {
        return $this->mudaeMessage->mudaeEmbed->image->url;
    }
}
